
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Example 2</title>
    <link rel="stylesheet" href="style.css" media="all" />
    <style>
      @font-face {
  font-family: SourceSansPro;
  src: url(SourceSansPro-Regular.ttf);
}

.clearfix:after {
  content: "";
  display: table;
  clear: both;
}

a {
  color: #0087C3;
  text-decoration: none;
}

body {
  position: relative;
  width: 21cm;  
  height: 29.7cm; 
  margin: 0 auto; 
  color: #555555;
  background: #FFFFFF; 
  font-family: Arial, sans-serif; 
  font-size: 14px; 
  font-family: SourceSansPro;
}

header {
  padding: 10px 0;
  margin-bottom: 20px;
  border-bottom: 1px solid #AAAAAA;
}

#logo {
  float: left;
  margin-top: 8px;
}

#logo img {
  height: 70px;
}

#company {
  float: right;
  text-align: right;
}


#details {
  margin-bottom: 50px;
}

#client {
  padding-left: 6px;
  border-left: 6px solid #0087C3;
  float: left;
}

#client .to {
  color: #777777;
}

h2.name {
  font-size: 1.4em;
  font-weight: normal;
  margin: 0;
}

#invoice {
  float: right;
  text-align: right;
}

#invoice h1 {
  color: #0087C3;
  font-size: 2.4em;
  line-height: 1em;
  font-weight: normal;
  margin: 0  0 10px 0;
}

#invoice .date {
  font-size: 1.1em;
  color: #777777;
}

table {
  width: 100%;
  border-collapse: collapse;
  border-spacing: 0;
  margin-bottom: 20px;
}

table th,
table td {
  padding: 20px;
  background: #EEEEEE;
  text-align: center;
  border-bottom: 1px solid #FFFFFF;
}

table th {
  white-space: nowrap;        
  font-weight: normal;
}

table td {
  text-align: right;
}

table td h3{
  color: #57B223;
  font-size: 1.2em;
  font-weight: normal;
  margin: 0 0 0.2em 0;
}

table .no {
  color: #FFFFFF;
  font-size: 1.6em;
  background: #57B223;
}

table .desc {
  text-align: left;
}

table .unit {
  background: #DDDDDD;
}

table .qty {
}

table .total {
  background: #57B223;
  color: #FFFFFF;
}

table td.unit,
table td.qty,
table td.total {
  font-size: 1.2em;
}

table tbody tr:last-child td {
  border: none;
}

table tfoot td {
  padding: 10px 20px;
  background: #FFFFFF;
  border-bottom: none;
  font-size: 1.2em;
  white-space: nowrap; 
  border-top: 1px solid #AAAAAA; 
}

table tfoot tr:first-child td {
  border-top: none; 
}

table tfoot tr:last-child td {
  color: #57B223;
  font-size: 1.4em;
  border-top: 1px solid #57B223; 

}

table tfoot tr td:first-child {
  border: none;
}

#thanks{
  font-size: 2em;
  margin-bottom: 50px;
}

#notices{
  padding-left: 6px;
  border-left: 6px solid #0087C3;  
}

#notices .notice {
  font-size: 1.2em;
}

footer {
  color: #777777;
  width: 100%;
  height: 30px;
  position: absolute;
  bottom: 0;
  border-top: 1px solid #AAAAAA;
  padding: 8px 0;
  text-align: center;
}


    </style>
  </head>
  <body>
    <header class="clearfix">
      <div id="logo">
        <img width="80" src="{{asset('frontend/images/invoice.jpg')}}">
      </div>
      <div id="company">
        <h2 class="name">The Mart Ltd</h2>
        <div>Meher Plaza,Dhanmondi 5, Dhaka, Bangladesh</div>
        <div>+8801863047064</div>
        <div><a href="mailto:company@example.com">fazlealahe.murad@gmail.com</a></div>
      </div>
      </div>
    </header>
    <main>
      <div id="details" class="clearfix">
        @php
            $bill = App\Models\Billing::where('order_id', $order_id)->first();
            $ship = App\Models\Shipping::where('order_id', $order_id)->first();
            $order_products = App\Models\OrderProducts::where('order_id', $order_id)->get();
            $order = App\Models\Order::where('order_id', $order_id)->first();
        @endphp
        <div id="client">
            <div style="margin-bottom: 8px">
                <div class="to">Bill TO:</div>
                <h2 class="name">{{$bill->fname.' '.$bill->lname}}</h2>
                <div class="address">{{$bill->address}}, {{$bill->rel_to_city->name}} {{$bill->zip}}, {{$bill->rel_to_country->name}}</div>
                <div class="email"><a href="mailto:john@example.com">{{$bill->email}}</a></div>
            </div>
            <div>
                <div class="to">Shipped TO:</div>
                <h2 class="name">{{$ship->ship_fname.' '.$ship->ship_lname}}</h2>
                <div class="address">{{$ship->ship_address}}, {{$ship->rel_to_city->name}} {{$ship->ship_zip}}, {{$ship->rel_to_country->name}}</div>
                <div class="email"><a href="mailto:john@example.com">{{$ship->ship_email}}</a></div>
            </div>
        </div>
        <div id="invoice">
          <h3>INVOICE {{$order_id}}</h3>
          <div class="date">Date of Invoice: {{$bill->created_at->format('d-m-Y')}}</div>
        </div>
      </div>
      <table border="0" cellspacing="0" cellpadding="0">
        <thead>
          <tr>
            <th class="no">#</th>
            <th class="desc">DESCRIPTION</th>
            <th class="unit">UNIT PRICE</th>
            <th class="qty">QUANTITY</th>
            <th class="total">TOTAL</th>
          </tr>
        </thead>
        <tbody>
            @php
                $sub = 0;
            @endphp
            @foreach ($order_products as $sl=>$order_product)
            <tr>
                <td class="no">{{$sl+1}}</td>
                <td class="desc">{{$order_product->rel_to_product->product_name}}</td>
                <td class="unit">&#2547;{{$order_product->price}}</td>
                <td class="qty">{{$order_product->quantity}}</td>
                <td class="total">&#2547;{{$order_product->price*$order_product->quantity}}</td>
            </tr>
            @php
                $sub += $order_product->price*$order_product->quantity;
            @endphp
          @endforeach
        </tbody>
        <tfoot>
          <tr>
            <td colspan="2"></td>
            <td colspan="2">SUBTOTAL</td>
            <td>&#2547;{{ $sub }}</td>
          </tr>
          <tr>
            <td colspan="2"></td>
            <td colspan="2">Delivery Charge</td>
            <td>&#2547;{{$order->delivery_charge}}</td>
          </tr>
          <tr>
            <td colspan="2"></td>
            <td colspan="2">Discount</td>
            <td>- &#2547;{{$order->discount}}</td>
          </tr>
          <tr>
            <td colspan="2"></td>
            <td colspan="2">GRAND TOTAL</td>
            <td>&#2547;{{$order->total}}</td>
          </tr>
        </tfoot>
      </table>
      <div id="thanks">Thank you!</div>
      <div id="notices">
        <div>NOTICE:</div>
        <div class="notice">A finance charge of 1.5% will be made on unpaid balances after 30 days.</div>
      </div>
    </main>
    <footer>
      Invoice was created on a computer and is valid without the signature and seal.
    </footer>
  </body>
</html>