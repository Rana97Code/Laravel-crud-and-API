<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Book;
use App\Model\User;
use App\Model\writer;
use App\Model\Cuponcode;
use DB;
use App\Model\Book_story;
use App\Model\Review;
use App\Model\Cart;
use App\Model\Order;
use App\Model\Wishlist;
use App\Model\Subscription;
use App\Model\Subscriptions_detail;
use App\Model\Package;
use App\Model\Package_detail;
use App\Model\Slideshow;


use App\Model\Package_sale;

class allapimethodcontroller extends Controller

{
 public function freebooks()
    {
        
        // $Book = Book::select('*')
        //                   ->where('category', '=', 'free')
        //                   ->get();
                           
                $Book = DB::table('books')
                ->join('writers', 'writers.id', '=', 'books.writer_id')
                ->join('categories', 'categories.id', '=', 'books.category_id')
                ->join('publications', 'publications.id', '=', 'books.publication_id')
                ->where('books.status', '=', 'free')
                ->select('books.*','writers.name AS wname','writers.id AS writer_id','categories.category_name AS category_name','categories.status AS category_status','publications.id As publication_id','publications.publication_name','publications.publication_image')
                //->groupBy('books.category_id')
                ->limit(10)
                ->get();
         return  $Book;
    }
    
    
    

    
    
    public function booksdetails($id)
    {
        
        // $book_stories= Book_story::where('book_id',$id)->get();
        // return $book_stories;
        //return  $book_stories;
        
    $cat=DB::table('book_stories')->get();
    $products_arr = array();
    $products_arr['data'] = array();
    // $most_popular_products_arr['data']['product'] = array();
     
    foreach ($cat as $cate) {
                
        $cBook = DB::table('book_stories')
                ->where('book_stories.book_id', '=', $id)
                ->select('book_stories.lesson','book_stories.lesson_story')
                //->groupBy('books.category_id')
                ->get();
                return $cBook;
        $product_item = array(
        'product'=>$cBook
         );
        
     array_push($products_arr['data'], $product_item);
        
        
}

        
         return $products_arr;
    }
    
    
    //  public function allcategorybooks($id)
    // {
        
       
       
    //   $Book = Book::join('writers', 'writers.id', '=', 'books.writer_id')
    //                           -> where ('books.status','!=','requested')
    //                           -> where('books.category_id', '=', $id)
    //                           ->select('books.*', 'writers.name AS wname')
    //                           ->orderBy('id', 'desc')
    //                           ->get();
                         
        
    //      return  $Book;
    // }
    
    
     public function allcategorybooks($id)
    {
        
        
         
        $cBook = DB::table('books')
                ->join('writers', 'writers.id', '=', 'books.writer_id')
                ->join('categories', 'categories.id', '=', 'books.category_id')
                ->join('publications', 'publications.id', '=', 'books.publication_id')
                //->join('reviews', 'reviews.book_id', '=', 'books.id')
                -> where('books.category_id', '=', $id)
                ->select('books.*','writers.name AS wname','writers.id AS writer_id','categories.category_name AS category_name','categories.status AS category_status','publications.id As publication_id','publications.publication_name','publications.publication_image')
                //->groupBy('books.category_id')
                ->limit(10)
                ->get();
  
  

        return $cBook;
 
    }
    
    
    public function newbooks()
    {
        
        $Book = DB::table('books')
                ->join('writers', 'writers.id', '=', 'books.writer_id')
                ->join('categories', 'categories.id', '=', 'books.category_id')
                ->join('publications', 'publications.id', '=', 'books.publication_id')
                ->select('books.*','writers.name AS wname','writers.id AS writer_id','categories.category_name AS category_name','categories.status AS category_status','publications.id As publication_id','publications.publication_name','publications.publication_image')
                //->groupBy('books.category_id')
                ->orderBy('books.id', 'desc')
                ->limit(10)
                ->get();
         return  $Book;
        
       
       
    }
    
    public function writersbooks($id)
    {
        
     
        //  $Book = Book::join('writers', 'writers.id', '=', 'books.writer_id')
        //                       -> where ('books.status','!=','requested')
        //                       -> where('books.writer_id', '=', $id)
        //                       ->select('books.*', 'writers.name AS wname')
        //                       ->orderBy('id', 'desc')
        //                       ->get();
                         
        // // $a = DB::table('books')
        // //     ->join('book_stories', 'book.id', '=', 'book_stories.book_id')
        // //     ->get();
        // //$a= Book::get();
        //  return  $Book;
        
        
        $cBook = DB::table('books')
                ->join('writers', 'writers.id', '=', 'books.writer_id')
                ->join('categories', 'categories.id', '=', 'books.category_id')
                ->join('publications', 'publications.id', '=', 'books.publication_id')
                -> where('books.writer_id', '=', $id)
                ->select('books.*','writers.name AS wname','writers.id AS writer_id','categories.category_name AS category_name','categories.status AS category_status','publications.id As publication_id','publications.publication_name','publications.publication_image')
                //->groupBy('books.category_id')
                
                ->get();
      
   //$cbook= Book::where('writer_id',$id)->get();
         return $cBook;
         
         
    }
    
    
    
    
    // public function limitbooks()
    // {
        
        
                           
    //                      $Book = Book::join('writers', 'writers.id', '=', 'books.writer_id')
    //                           -> where ('books.status','=','free')
    //                           ->select('books.*', 'writers.name AS wname')
    //                           ->orderBy('id', 'desc')
    //                           ->limit(10)
    //                           ->get();
                           
       
    //      return  $Book;
    // }
    
  
    
    //  public function limitallcategorybooks($id)
    // {
        
      
       
    //   $Book = Book::join('writers', 'writers.id', '=', 'books.writer_id')
    //                           -> where ('books.status','!=','requested')
    //                           -> where('books.category_id', '=', $id)
    //                           ->select('books.*', 'writers.name AS wname')
    //                           ->orderBy('id', 'desc')
    //                           ->limit(10)
    //                           ->get();
                         
        
    //      return  $Book;
    // }
    
    
    // public function limitnewbooks()
    // {
        
    //      $Book = Book::join('writers', 'writers.id', '=', 'books.writer_id')
    //                           -> where ('books.status','!=','requested')
    //                           ->select('books.*', 'writers.name AS wname')
    //                           ->orderBy('id', 'desc')
    //                           ->limit(10)
    //                           ->get();
                         
        
    //      return  $Book;
    // }
    
    // public function limitwritersbooks($id)
    // {
        
        
        
    //      $Book = Book::join('writers', 'writers.id', '=', 'books.writer_id')
    //                           -> where ('books.status','!=','requested')
    //                           -> where('books.writer_id', '=', $id)
    //                           ->select('books.*', 'writers.name AS wname')
    //                           ->orderBy('id', 'desc')
    //                           ->limit(10)
    //                           ->get();
                         
       
    //      return  $Book;
    // }
     
    
    public function publicationbook($id)
    {

        $cBook = DB::table('books')
                ->join('writers', 'writers.id', '=', 'books.writer_id')
                ->join('categories', 'categories.id', '=', 'books.category_id')
                ->join('publications', 'publications.id', '=', 'books.publication_id')
                -> where('books.publication_id', '=', $id)
                ->select('books.*','writers.name AS wname','writers.id AS writer_id','categories.category_name AS category_name','categories.status AS category_status','publications.id As publication_id','publications.publication_name','publications.publication_image')
                //->groupBy('books.category_id')
                ->limit(10)
                ->get();
       
        
  

         return $cBook;

    }
    
    
    public function homecategorybooks()
    {
        
    //SELECT * FROM books JOIN categories ON books.category_id = categories.id JOIN writers ON books.writer_id = writers.id
       
    
    // $Book = DB::table('books')
    //         ->join('writers', 'writers.id', '=', 'books.writer_id')
    //         ->join('categories', 'categories.id', '=', 'books.category_id')
    //         ->select('*')
    //         //->groupBy('books.category_id')
    //         ->get();
    
    $cat=DB::table('categories')->get();
    $products_arr = array();
    $products_arr['data'] = array();
    // $most_popular_products_arr['data']['product'] = array();
    
    foreach ($cat as $cate) {
                
        $cBook = DB::table('books')
                ->join('writers', 'writers.id', '=', 'books.writer_id')
                ->join('categories', 'categories.id', '=', 'books.category_id')
                ->join('publications', 'publications.id', '=', 'books.publication_id')
                //->join('reviews', 'reviews.book_id', '=', 'books.id')
                ->where('books.category_id', '=', $cate->id)
                ->select('books.*','writers.name AS wname','writers.id AS writer_id','categories.category_name AS category_name','categories.status AS category_status','publications.id As publication_id','publications.publication_name','publications.publication_image')
                //->groupBy('books.category_id')
                ->limit(10)
                ->get();
        $product_item = array(
          
        'cat_id'=>$cate->id,
        'cat_name'=>$cate->category_name,
        'product'=>$cBook,
        
        
         
         );
        
     array_push($products_arr['data'], $product_item);
        
        
}

        
         return $products_arr;
    }
    
    
    //user review
    
        public function review(Request $request)
    {
        // return "done";
      
        //     //'phone'  => 'required|min:11|numeric',
      
        
        //  $this->validate($request, [
             
        //     'user_id' => ['required'],
        //     'ratting' => ['required'],
        //     'book_id' => ['required'],
        //     'review_details' => ['required'],
        // ]);

        $review = new Review();

        $review->user_id = $request->user_id;
        $review->ratting = $request->ratting;
        $review->book_id = $request->book_id;
        $review->review_details = $request->review_details;
        // $review->created_at = $request->created_at;
        // $review->updated_at = $request->updated_at;

        $review->save();
        
        //return $this->login($request);
        
         return response()->json([
            'result' => true,
            'message' => "review Successfully Done !",
        ]);
        
    }
    
    
    //get review
    
    public function getreview($id)
    {

        $cBook = DB::table('reviews')
                ->join('users', 'users.id', '=', 'reviews.user_id')
                -> where('reviews.book_id', '=', $id)
                ->select('reviews.*','users.id AS user_id','users.name AS user_name','users.user_image AS user_image')
                //->groupBy('books.category_id')
                ->get();
       
        
  

         return $cBook;

    }

        
      
    
    //cart insert
    
        public function cart(Request $request)
    {
        // return "done";
      
        //     //'phone'  => 'required|min:11|numeric',
      
        
        //  $this->validate($request, [
             
        //     'user_id' => ['required'],
        //     'ratting' => ['required'],
        //     'book_id' => ['required'],
        //     'review_details' => ['required'],
        // ]);

        $carts = new Cart();

        $carts->user_id = $request->user_id;
        $carts->book_id = $request->book_id;
        $carts->quantity = $request->quantity;
        $carts->book_type = $request->book_type;
        $carts->audio_status = $request->audio_status;
        $carts->sub_total_price = $request->sub_total_price;

        // $review->created_at = $request->created_at;
        // $review->updated_at = $request->updated_at;

        $carts->save();
        
        //return $this->login($request);
        
         return response()->json([
            'result' => true,
            'message' => "cart Successfully Done !",
        ]);
        
    }
    
    //get audio
    
    
    public function getaudio($id)
    {
        
        $total_audio_price = DB::table('book_audios')
                 ->select(DB::raw('sum(price) as total_price'))
                 ->groupBy('book_id')
                 ->get();
                 
                 
        $cBook = DB::table('book_audios')
                -> where('book_id', '=', $id)
                //->groupBy('books.category_id')
                ->get();

    $products_arr = array();
    $products_arr['data'] = array();
    // $most_popular_products_arr['data']['product'] = array();
  
        $product_item = array(
        
        'total_audio_price'=>$total_audio_price,
        'cartaudiobook'=>$cBook,
        
        
         
         );
         
        
     array_push($products_arr['data'], $product_item);
        
        


        
         return $products_arr;

      
          
    }
    
    
    //all audio
    
     
    public function allaudio()
    {
         $cBook = DB::table('book_audios')
          ->orderBy('book_audios.id', 'desc')
                ->get();



        
         return $cBook;

      
          
    }
    
    //get cart data 
    
    
    
    
    
    public function ebookcartsdata($id)
    {
        
        $cart = DB::table('carts')
                //->join('books', 'books.id', '=', 'carts.book_id')
                -> where('carts.user_id', '=', $id)
               // -> where('carts.book_id', '=', 'books.id')
                -> where('carts.book_type', '=', 'ebook')
                ->get();

    $products_arr = array();
    $products_arr['data'] = array();
    // $most_popular_products_arr['data']['product'] = array();
    foreach ($cart as $cate) {
         
        $cBook = DB::table('books')
                ->where('books.id', '=', $cate->book_id)
                ->get();
        $product_item = array(
        'cart_id'=>$cate->id,
        'cart_quantity'=>$cate->quantity,
        'cart_book_type'=>$cate->book_type,
        'cart_audio_status'=>$cate->audio_status,
        'cart_sub_total_price'=>$cate->sub_total_price,
        'cartbook'=>$cBook,
        
        
         
         );
         
        
     array_push($products_arr['data'], $product_item);
        
        
}

        
         return $products_arr;

    }
    
     public function hardCopycartsdata($id)
    {
        
        
        $cart = DB::table('carts')
                -> where('carts.user_id', '=', $id)
                -> where('carts.book_type', '=', 'hardCopy')
                ->get();
       
                
 
    $products_arr = array();
    $products_arr['data'] = array();
    foreach ($cart as $cate) {
         
        $cBook = DB::table('books')
                ->where('books.id', '=', $cate->book_id)
                ->get();
        $product_item = array(
        'cart_id'=>$cate->id,
        'cart_quantity'=>$cate->quantity,
        'cart_book_type'=>$cate->book_type,
        'cart_audio_status'=>$cate->audio_status,
        'cart_sub_total_price'=>$cate->sub_total_price,
        'cartbook'=>$cBook,
        
        
         
         );
         
        
     array_push($products_arr['data'], $product_item);
        
        
}

        
         return $products_arr;


    }
    
    //cart qty update
    
    public function cartsqty(Request $request)
    {
       // return $request;
        
      $cart = Cart::find($request->id);
      $cart->quantity = $request->quantity;
      $cart->sub_total_price= $request->sub_total_price	;
       
       
        
        //return $this->login($request);
         if ( $cart->save()){
            
            $data=[
            'msg'=>'success'
            
          ];
         return response()->json($data);
          }else{
            $data=[
            'msg'=>'fail'
          ];
          }
                       
          return response()->json($data);
        
       
    }
    
    
    
    
    
    
    
    
    
    
    
    
//     public function cartsqty($id)
//     {
      
//     $cart= DB::table('carts')
//   ->where('id', $id)
//   ->update([
//       'quantity' => DB::raw('quantity + 1'),
//   ]);
                
//     return response()->json([
//             'result' => true,
//         ]);

//     }
    
    //cart delete
    
    public function cartdlt($id)
    {
        
            $res=Cart::find($id)->delete();
          if ($res){
            $data=[
            
            'msg'=>'success'
          ];
          }else{
            $data=[
           
            'msg'=>'fail'
          ];
          }
          return response()->json($data);
    }
    

    
    // //orders
    
    
    //  public function order(Request $request)
    // {
       
        
    //     $carts = new Cart();
        
    //     $carts->user_id = $request->user_id;
    //     $carts->book_id = $request->book_id;
    //     $carts->quantity = $request->quantity;
    //     $carts->sub_total_price = $request->sub_total_price;
    //     $carts->grand_total_price = $request->grand_total_price;
        
    //     // $review->created_at = $request->created_at;
    //     // $review->updated_at = $request->updated_at;
        
    //     $carts->save();
        
    //     //return $this->login($request);
        
    //      return response()->json([
    //         'result' => true,
    //         'message' => "review Successfully Done !",
    //     ]);
        
    // }
    
    
    
    //wishlist add
    
    
     public function wishlist(Request $request)
    {
       
        
        $wishlists = new wishlist();
        
        $wishlists->user_id = $request->user_id;
        $wishlists->book_id = $request->book_id;
        $wishlists->writer_id = $request->writer_id;
        // $review->created_at = $request->created_at;
        // $review->updated_at = $request->updated_at;
        
        $wishlists->save();
        
        //return $this->login($request);
        
         return response()->json([
            'result' => true,
            'message' => "wishlist Successfully Done !",
        ]);
        
    }
    
    //get wishlist data
    
    public function wishlistsdata($id)
    {
        
        $wishlists = DB::table('wishlists')
                ->join('books', 'books.id', '=', 'wishlists.book_id')
                ->join('writers', 'writers.id', '=', 'wishlists.writer_id')
                -> where('wishlists.user_id', '=', $id)
                ->select('books.*','writers.name AS writer_name')
                ->get();

        
         return $wishlists;

    }
    
    
    //writer follwer
    
    
    public function follwer($id)
    {
      
    $follwer= DB::table('writers')
   ->where('id', $id)
   ->update([
       'follower_count' => DB::raw('follower_count + 1'),
   ]);
                
    return response()->json([
            'result' => true,
        ]);

    }
    
    //promocode
       
     public function promocode(Request $request)
    {
       
       

        $code= $request->code;
        $codevalid= DB::table('cuponcodes')
                ->get();
                       // return $codevalid;
        foreach ($codevalid as $codevalid_all) {
 
        if ($codevalid_all->promocode==$code){
            
            $data=[
            'amount'=>$codevalid_all->discount_amount,
            'msg'=>'success'
            
          ];
         return response()->json($data);
          }else{
            $data=[
            'amount'=>0,
            'msg'=>'fail'
          ];
          }
                       }
          return response()->json($data);
        
       
        
    }
    
    
    
    
    
    //review list
    
    
    public function review_list($id)
    {
      
     $cBook = DB::table('reviews')
                //->join('books', 'books.id', '=', 'reviews.book_id')
                ->join('users', 'users.id', '=', 'reviews.user_id')
                //->join('publications', 'publications.id', '=', 'books.publication_id')
                //->join('reviews', 'reviews.book_id', '=', 'books.id')
                -> where('reviews.book_id', '=', $id)
                ->select('users.*', 'reviews.*')
                //->groupBy('books.category_id')
                ->get();
                return $cBook;

    }
    
    //subscriptions
    
    public function subs()
    {
       $Book = Subscription::select('*') ->get();
        
        // $Book = DB::table('subscriptions')
        //         ->join('users', 'users.id', '=', 'subscriptions.writer_id')
               
        //         ->select('books.*', 'writers.name AS wname','writers.id','categories.*','categories.status AS category_status','publications.*')
        //         //->groupBy('books.category_id')
        //         ->orderBy('books.id', 'desc')
        //         ->limit(10)
        //         ->get();
         return  $Book;
        
       
       
    }
   
    //user profile update
    
     public function userupdate(Request $request)
    {
        
        // $user = Category::find($id);


        
        //  $this->validate($request, [
        //     'name' => ['required', 'string', 'max:255'],
        //     'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        //     'phone' => ['required','min:11' , 'unique:users'],
           
        // ]);
        //return $request->id;
        
       

        $user = User::find($request->id);
       // return $request->name;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->point = $request->point;
        $user->date_of_birth = $request->date_of_birth;
        $user->institution = $request->institution;
        $user->division = $request->division;
        $user->p_m_number = $request->p_m_number;
        $user->gender = $request->gender;
        
        if ($request->hasFile('user_image')) {
            //insert that image
            $user_image = $request->file('user_image');
            $imgName = rand(1111, 9999) . date('.d-m-y.') . '.' . $user_image->getClientOriginalExtension();
            $location = public_path('frontend/images/userimage/' . $imgName);
            Image::make($user_image)->save($location);


            $user->user_image = $imgName;
        }
        
        
        
        
        //return $this->login($request);
         if ( $user->save()){
            
            $data=[
            'msg'=>'success'
            
          ];
         return response()->json($data);
          }else{
            $data=[
            'msg'=>'fail'
          ];
          }
                       
          return response()->json($data);
        
       
    }
    //coin update
    
    
     public function updatecoin(Request $request)
    {
     $user_coin= DB::table('users')
       ->where('id', $request->id)
       ->value('users.coin');

     
       $total_coin=$user_coin + $request->coin;
        $user = User::find($request->id);
        $user->coin =$total_coin;

        
        //return $this->login($request);
         if ( $user->save()){
            
            $data=[
            'msg'=>'success'
            
          ];
         return response()->json($data);
          }else{
            $data=[
            'msg'=>'fail'
          ];
          }
                       
          return response()->json($data);
        
       
    }
    
    //point update
    

     public function updatepoint(Request $request)
    {
     $user_coin= DB::table('users')
       ->where('id', $request->id)
       ->value('users.point');

     
       $total_coin=$user_coin + $request->point;
        $user = User::find($request->id);
        $user->point =$total_coin;

        
        //return $this->login($request);
         if ( $user->save()){
            
            $data=[
            'msg'=>'success'
            
          ];
         return response()->json($data);
          }else{
            $data=[
            'msg'=>'fail'
          ];
          }
                       
          return response()->json($data);
        
       
    }
    
    //order data insert
    
     public function order(Request $request)
    {
       
      
        $order = new Order();
        
        $order->user_id = $request->user_id;
        $order->order_number = $request->order_number;
        $order->shipping_address = $request->shipping_address;
        $order->total_price = $request->total_price;
        $order->order_date = $request->order_date;
        
        $order->save();
        
        //return $this->login($request);
        
         return response()->json([
            'result' => true,
            'message' => "Order Successfully Done !",
        ]);
        
    }
    
    
    //subscripstion_details data insert
    
     public function s_details(Request $request)
    {
       
      
        $s_details = new Subscriptions_detail();
        $s_details->user_id = $request->user_id;
        $s_details->start_date = $request->start_date;
        $s_details->end_date = $request->end_date;
        $s_details->status = $request->status;
        $s_details->save();
        
        //return $this->login($request);
        
         return response()->json([
            'result' => true,
            'message' => "Subscriptions Successfully Done !",
        ]);
        
    }
   // package data
    
    public function pac()
    {
      $pac = DB::table('packages')
                ->get();
         return  $pac;
        
       
       
    }
    
    //package details
    
//     public function pac_details()
//     {
       
      
//          $pac = DB::table('packages')
//                 ->join('package_details', 'package_details.package_id', '=', 'packages.id')
//                  ->select('packages.*', 'package_details.id As package_details_id', 'package_details.book_id As package_details_book_id')
//                 ->get();
       
               
 
//     $products_arr = array();
//     $products_arr['data'] = array();
//     foreach ($pac as $cate) {
         
//         $cBook = DB::table('books')
//                 ->where('books.id', '=', $cate->package_details_book_id)
//                 ->get();
//         $product_item = array(
//         'packages_id'=>$cate->id,
//         'packages_name'=>$cate->package_name,
//         'packages_thumbnail'=>$cate->thumbnail,
//         'packages_selling_price_ebook'=>$cate->selling_price_ebook,
//         'packages_selling_price_hardcopy'=>$cate->selling_price_hardcopy,
//         'packages_dec'=>$cate->book_description,
//         'package_book_list'=>$cBook,
        
        
         
//          );
         
        
//      array_push($products_arr['data'], $product_item);
        
        
// }

        
//          return $products_arr;
//     }


//package details
    
    public function pac_details($id)
    {
       
      
         $pac = DB::table('packages')
                ->join('package_details', 'package_details.package_id', '=', 'packages.id')
                -> where('package_details.package_id', '=', $id)
                 ->select('packages.package_name', 'package_details.*')
                ->get();
       
              // return $pac;
 
    $products_arr = array();
    $products_arr['data'] = array();
    foreach ($pac as $cate) {
         
         
          $Book = DB::table('books')
                ->join('writers', 'writers.id', '=', 'books.writer_id')
                ->join('categories', 'categories.id', '=', 'books.category_id')
                ->join('publications', 'publications.id', '=', 'books.publication_id')
                ->where('books.id', '=', $cate->book_id)
                ->select('books.*','writers.name AS wname','writers.id AS writer_id','categories.category_name AS category_name','categories.status AS category_status','publications.id As publication_id','publications.publication_name','publications.publication_image')
                ->get();
        // $cBook = DB::table('books')
        //         ->where('books.id', '=', $cate->book_id)
        //         ->get();
        $product_item = array(
        'packages_id'=>$cate->package_id,
        'packages_name'=>$cate->package_name,
        'package_book_list'=>$Book
        
        
         
         );
         
        
     array_push($products_arr['data'], $product_item);
        
        
}

        
         return $products_arr;
    }
    
    
    //package buye
    
     public function p_sale(Request $request)
    {
        
       
      
        $p_sale = new Package_sale();
        $p_sale->user_id = $request->user_id;
        $p_sale->package_id = $request->package_id;

        $p_sale->save();
        
        //return $this->login($request);
        
         return response()->json([
            'result' => true,
            'message' => "package sale Successfully Done !",
        ]);
        
    }
    //site_setting 
    
    public function site_setting()
    {
      $site_setting = DB::table('slideshows')
                ->orderBy('slideshows.id', 'desc')
                ->limit(4)
                ->get();
         return  $site_setting;
        
       
       
    }
    
    //search api
    
      public function search($name)
    {
                
                return Book::where('name','LIKE','%'.$name.'%')
                                    ->get();

    }
    

 }
