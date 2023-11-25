<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Adverisement;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\ProductVariantItem;
use Illuminate\Http\Request;
use Cart;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{

    /** Hiển thị trang giỏ hàng  */
    public function cartDetails()
    {
        $cartItems = Cart::content();

        if(count($cartItems) === 0){
            Session::forget('coupon');
            toastr('Vui lòng thêm một số sản phẩm vào giỏ hàng của bạn để xem trang giỏ hàng', 'warning', 'Giỏ hàng trống rỗng!');
            return redirect()->route('home');
        }

        $cartpage_banner_section = Adverisement::where('key', 'cartpage_banner_section')->first();
        $cartpage_banner_section = json_decode($cartpage_banner_section?->value);

        return view('frontend.pages.cart-detail', compact('cartItems', 'cartpage_banner_section'));
    }

    /** Thêm sp vào giỏ hàng */
    public function addToCart(Request $request)
    {

        $product = Product::findOrFail($request->product_id);

        // Kiểm tra số lượng sản phẩm
        if($product->qty === 0){
            return response(['status' => 'error', 'message' => 'Hết sản phẩm']);
        }elseif($product->qty < $request->qty){
            return response(['status' => 'error', 'message' => 'Số lượng không có sẵn trong kho của chúng tôi']);
        }

        $variants = [];
        $variantTotalAmount = 0;

        if($request->has('variants_items')){
            foreach($request->variants_items as $item_id){
                $variantItem = ProductVariantItem::find($item_id);
                $variants[$variantItem->productVariant->name]['name'] = $variantItem->name;
                $variants[$variantItem->productVariant->name]['price'] = $variantItem->price;
                $variantTotalAmount += $variantItem->price;
            }
        }


        /** Kiểm tra mã giảm giá */
        $productPrice = 0;

        if(checkDiscount($product)){
            $productPrice = $product->offer_price;
        }else {
            $productPrice = $product->price;
        }

        $cartData = [];
        $cartData['id'] = $product->id;
        $cartData['name'] = $product->name;
        $cartData['qty'] = $request->qty;
        $cartData['price'] = $productPrice;
        $cartData['weight'] = 10;
        $cartData['options']['variants'] = $variants;
        $cartData['options']['variants_total'] = $variantTotalAmount;
        $cartData['options']['image'] = $product->thumb_image;
        $cartData['options']['slug'] = $product->slug;

        Cart::add($cartData);

        return response(['status' => 'success', 'message' => 'Đã thêm vào giỏ hàng thành công!']);
    }

    /** Cập nhật lại số lượng sản phẩm */
    public function updateProductQty(Request $request)
    {
        $productId = Cart::get($request->rowId)->id;
        $product = Product::findOrFail($productId);

        // Kiểm tra số lượng sản phẩm
        if($product->qty === 0){
            return response(['status' => 'error', 'message' => 'Hết sản phẩm']);
        }elseif($product->qty < $request->qty){
            return response(['status' => 'error', 'message' => 'Số lượng không có sẵn trong kho của chúng tôi']);
        }

        Cart::update($request->rowId, $request->quantity);
        $productTotal = $this->getProductTotal($request->rowId);

        return response(['status' => 'success', 'message' => 'Số lượng sản phẩm được cập nhật!', 'product_total' => $productTotal]);
    }

    /** Nhận tổng số sản phẩm */
    public function getProductTotal($rowId)
    {
       $product = Cart::get($rowId);
       $total = ($product->price + $product->options->variants_total) * $product->qty;
       return $total;
    }

    /** Nhận tổng số tiền trong giỏ hàng */
    public function cartTotal()
    {
        $total = 0;
        foreach(Cart::content() as $product){
            $total += $this->getProductTotal($product->rowId);
        }

        return $total;
    }

    /** Xóa tất cả các sản phẩm giỏ hàng */
    public function clearCart()
    {
        Cart::destroy();

        return response(['status' => 'success', 'message' => 'Giỏ hàng đã được xóa thành công']);
    }

    /** Xóa giỏ hàng trong form sản phẩm*/
    public function removeProduct($rowId)
    {
        Cart::remove($rowId);
        toastr('Sản phẩm được loại bỏ thành công!', 'success', 'Success');
        return redirect()->back();
    }

    /** Nhận số lượng giỏ hàng */
    public function getCartCount()
    {
        return Cart::content()->count();
    }

    /** Nhận tất cả các sản phẩm giỏ hàng */
    public function getCartProducts()
    {
        return Cart::content();
    }

    /** Xóa mẫu sản phẩm giỏ hàng thanh sidebars */
    public function removeSidebarProduct(Request $request)
    {
        Cart::remove($request->rowId);

        return response(['status' => 'success', 'message' => 'Sản phẩm đã được gỡ bỏ thành công!']);
    }

    /** Apply coupon */
    public function applyCoupon(Request $request)
    {
        if($request->coupon_code === null){
            return response(['status' => 'error', 'message' => 'Coupon filed is required']);
        }

        $coupon = Coupon::where(['code' => $request->coupon_code, 'status' => 1])->first();

        if($coupon === null){
            return response(['status' => 'error', 'message' => 'Phiếu giảm giá không tồn tại!']);
        }elseif($coupon->start_date > date('Y-m-d')){
            return response(['status' => 'error', 'message' => 'Phiếu giảm giá không tồn tại!']);
        }elseif($coupon->end_date < date('Y-m-d')){
            return response(['status' => 'error', 'message' => 'Phiếu giảm giá đã hết hạn']);
        }elseif($coupon->total_used >= $coupon->quantity){
            return response(['status' => 'error', 'message' => 'Bạn không thể áp dụng phiếu giảm giá này']);
        }

        if($coupon->discount_type === 'amount'){
            Session::put('coupon', [
                'coupon_name' => $coupon->name,
                'coupon_code' => $coupon->code,
                'discount_type' => 'amount',
                'discount' => $coupon->discount
            ]);
        }elseif($coupon->discount_type === 'percent'){
            Session::put('coupon', [
                'coupon_name' => $coupon->name,
                'coupon_code' => $coupon->code,
                'discount_type' => 'percent',
                'discount' => $coupon->discount
            ]);
        }

        return response(['status' => 'success', 'message' => 'Phiếu giảm giá được áp dụng thành công!']);
    }

    /** Tính chiết khấu phiếu giảm giá */
    public function couponCalculation()
    {
        if(Session::has('coupon')){
            $coupon = Session::get('coupon');
            $subTotal = getCartTotal();
            if($coupon['discount_type'] === 'amount'){
                $total = $subTotal - $coupon['discount'];
                return response(['status' => 'success', 'cart_total' => $total, 'discount' => $coupon['discount']]);
            }elseif($coupon['discount_type'] === 'percent'){
                $discount = $subTotal - ($subTotal * $coupon['discount'] / 100);
                $total = $subTotal - $discount;
                return response(['status' => 'success', 'cart_total' => $total, 'discount' => $discount]);
            }
        }else {
            $total = getCartTotal();
            return response(['status' => 'success', 'cart_total' => $total, 'discount' => 0]);
        }
    }

}
