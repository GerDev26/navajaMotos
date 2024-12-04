<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{$invoice_title}}</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f9f9f9;
      color: #333;
    }
    .invoice-container {
      max-width: 800px;
      margin: 20px auto;
      padding: 20px;
      background: #fff;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      border-radius: 8px;
    }
    
    header, .client-info {
      width: 50%;
      box-sizing: border-box;
    }
    
    header {
      float: left;
    }
    .client-info {
      float: right;
      text-align: left;
    }
    
    img {
      width: 100px;
      border-radius: 10%;
      height: 100px;
    }
    
    .clearfix::after {
      content: "";
      display: table;
      clear: both;
    }
    
    section {
      margin-bottom: 20px;
    }
    
    section h2 {
      font-size: 18px;
      font-weight: bold;
      color: #13311c;
      margin-bottom: 10px;
    }
    
    table {
      width: 100%;
      border-collapse: collapse;
    }
    
    table th,
    table td {
      text-align: left;
      padding: 8px;
      border: 1px solid #2f834a;
    }
    
    table th {
      background-color: #256439;
      font-weight: bold;
      color: white;
    }
    
    footer {
      color: #13311c;
      text-align: right;
      font-size: 18px;
      margin-top: 40px;
    }
    footer p {
      margin: 6px;
    }
    footer p:last-child {
      font-size: 20px;
    }
    .line{
      width: 100%;
      height: 1px;
      background-color: #2f834a;
      margin: 10px 0px 10px 0px;
    }
  </style>
</head>
<body>
  <div class="invoice-container">
    <div style="width: 100%; margin-bottom: 20px;" class="clearfix">
      <img style="float: left;" src="{{ public_path('images/logo.jpg') }}" alt="">
      <p class="client-info" style="text-align: right; width: 100%;">Fecha de emisión: <strong>{{$date}}</strong></p>
    </div>
    <div class="clearfix">
      <header>
        <p>Empresa: <strong>Navaja Motos</strong></p>
        <p>Direccion: <strong>Berazategui Calle 111 1655</strong></p>
        <p>Telefono: <strong>+541158923152</strong></p>
      </header>
      <div class="client-info">
        <p>Cliente: <strong>{{$customer->username}}</strong></p>
        <p>Vehiculo: <strong>{{$vehicle->model->description}}</strong></p>
        <p>Patente: <strong>{{$vehicle->domain}}</strong></p>
      </div>
    </div>
    <div class="line"></div>
    <section>
      <h2>Repuestos</h2>
      <table>
        <thead>
          <tr>
            <th>Descripción</th>
            <th>Cantidad</th>
            <th>Precio</th>
            <th>Total</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($invoice_replacements as $replacement)
          <tr>
            <td>{{$replacement->replacement->description}}</td>
            <td>{{$replacement->quantity}}</td>
            <td>${{$replacement->unit_price}}</td>
            <td>${{$replacement->unit_price * $replacement->quantity}}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </section>
    <section>
      <h2>Mano de obra</h2>
      <table>
        <thead>
          <tr>
            <th>Descripción</th>
            <th>Precio</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($invoice_works as $work)
          <tr>
            <td>{{$work->work->description}}</td>
            <td>${{$work->unit_price}}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </section>
    <footer>
      <p>Subtotal: <strong>${{$total_price}}</strong></p>
      <p>Adelanto: <strong>${{$advancement}}</strong></p>
      <div class="line"></div>

      <p>Total: <strong>${{$total_price - $advancement}}</strong></p>
    </footer>
  </div>
</body>
</html>
