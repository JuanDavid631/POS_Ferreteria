<div class="content-header">
 <div class="container-fluid">
  <div class="row mb-2">
   <div class="col-sm-6">
    <h2 class="m-0">Tablero Principal</h2>
   </div>
  </div>
 </div>
</div>

<div class="content">
 <div class="container-fluid">
  <!-- Tarjetas Informativas -->
  <div class="row">
   <div class="col-lg-1">

   </div>
   <!-- Productos -->
   <div class="col-lg-2">
    <div class="small-box bg-info">
     <div class="inner">
      <h4 id="totalProductos"></h4>
      <p>Productos</p>
     </div>
     <div class="icon">
      <i class="ion ion-clipboard"></i>
     </div>
     <a style="cursor:pointer;" class="small-box-footer">Mas Info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
   </div>

   <!-- Compras -->
   <div class="col-lg-2">
    <div class="small-box bg-success">
     <div class="inner">
      <h4 id="totalCompras"></h4>
      <p>Costo Inventario</p>
     </div>
     <div class="icon">
      <i class="ion ion-cash"></i>
     </div>
     <a style="cursor:pointer;" class="small-box-footer">Mas Info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
   </div>

   <!-- Ventas -->
   <div class="col-lg-2">
    <div class="small-box bg-warning">
     <div class="inner">
      <h4 id="totalVentas"></h4>
      <p>Total Ventas</p>
     </div>
     <div class="icon">
      <i class="ion ion-ios-cart"></i>
     </div>
     <a style="cursor:pointer;" class="small-box-footer">Mas Info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
   </div>

   <!-- Ganancias -->
   <div class="col-lg-2">
    <div class="small-box bg-danger">
     <div class="inner">
      <h4 id="totalGanancias"></h4>
      <p>Total Ganancias</p>
     </div>
     <div class="icon">
      <i class="ion ion-ios-pie"></i>
     </div>
     <a style="cursor:pointer;" class="small-box-footer">Mas Info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
   </div>

   <!-- Poco productos -->
   <div class="col-lg-2">
    <div class="small-box bg-primary">
     <div class="inner">
      <h4 id="totalProductosMinStock"></h4>
      <p>Productos con poco stock</p>
     </div>
     <div class="icon">
      <i class="ion ion-android-remove-circle"></i>
     </div>
     <a style="cursor:pointer;" class="small-box-footer">Mas Info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
   </div>

   <!-- Graficas Informativas -->
   <div class="row">
    <div class="col-12">
     <div class="card card-gray shadow">
      <div class="card-header">
       <h3 class="card-title" id="card-titulo"></h3>
       <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse">
         <i class="fas fa-minus"></i>
        </button>
        <button type="button" class="btn btn-tool text-danger" data-card-widget="remove">
         <i class="fas fa-times"></i>
        </button>
       </div>
      </div>
      <div class="card-body">
       <div class="chart">
        <canvas id="barChart" style="min-height: 250px; height: 300px; max-height: 350px; width: 100%;">
        </canvas>
       </div>
      </div>
     </div>
    </div>
   </div>

   <div class="row">
    <div class="col-lg-6">
     <div class="card card-info">
      <div class="card-header">
       <h3 class="card-title">LOS 10 PRODUCTOS MAS VENDIDOS</h3>
       <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse">
         <i class="fas fa-minus"></i>
        </button>
        <button type="button" class="btn btn-tool text-danger" data-card-widget="remove">
         <i class="fas fa-times"></i>
        </button>
       </div>
      </div>
      <div class="card-body">
       <div class="table-responsive">
        <table class="table" id="tbl_productos_mas_vendidos">
         <thead>
          <tr class="text-danger">
           <th>Producto</th>
           <th class="text-center">Cantidad</th>
           <th class="text-center">Ventas</th>
          </tr>
         </thead>
         <tbody></tbody>
        </table>
       </div>
      </div>
     </div>
    </div>
    <div class="col-lg-6">
     <div class="card card-info">
      <div class="card-header">
       <h3 class="card-title">PRODUCTOS CON POCO STOCK</h3>
       <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse">
         <i class="fas fa-minus"></i>
        </button>
        <button type="button" class="btn btn-tool text-danger" data-card-widget="remove">
         <i class="fas fa-times"></i>
        </button>
       </div>
      </div>
      <div class="card-body">
       <div class="table-responsive">
        <table class="table" id="tbl_productos_poco_stock">
         <thead>
          <tr class="text-danger">
           <th>Producto</th>
           <th class="text-center">Stock Actual</th>
           <th class="text-center">Mínimo Stock</th>
          </tr>
         </thead>
         <tbody></tbody>
        </table>
       </div>
      </div>
     </div>
    </div>
   </div>
  </div>
 </div>

 <script>
 $(document).ready(function() {
  cargarTarjetasInformativas();
  cargarGraficoBarras();
  cargarProductosMasVendidos();
  cargarProductosPocoStock();

  setInterval(() => {
   $.ajax({
    url: "ajax/dashboard.ajax.php",
    method: 'POST',
    dataType: 'json',
    success: function(respuesta) {
     $("#totalProductos").html(respuesta[0]['totalProductos']);
     $("#totalCompras").html(respuesta[0]['totalCompras']);
     $("#totalVentas").html(respuesta[0]['totalVentas']);
     $("#totalGanancias").html(respuesta[0]['ganancias']);
     $("#totalProductosMinStock").html(respuesta[0]['productosPocoStock']);
    }
   });
  }, 10000);
 })

 /* =======================================================
									SOLICITUD AJAX TARJETAS INFORMATIVAS
 ==========================================================*/
 function cargarTarjetasInformativas() {
  $.ajax({
   url: "ajax/dashboard.ajax.php",
   method: 'POST',
   dataType: 'json',
   success: function(respuesta) {
    console.log("respuesta", respuesta);
    $("#totalProductos").html(respuesta[0]['totalProductos']);
    $("#totalCompras").html(respuesta[0]['totalCompras'])
    $("#totalVentas").html(respuesta[0]['totalVentas'])
    $("#totalGanancias").html(respuesta[0]['ganancias'])
    $("#totalProductosMinStock").html(respuesta[0]['productosPocoStock'])
    $("#totalVentasHoy").html(respuesta[0]['ventasHoy'])
   }
  });
 }

 /* =======================================================
      SOLICITUD AJAX GRAFICO DE BARRAS DE VENTAS DEL MES
			=======================================================*/
 function cargarGraficoBarras() {
  $.ajax({
   url: "ajax/dashboard.ajax.php",
   method: 'POST',
   data: {
    'accion': 1 //Parametro para obtener las ventas del mes
   },
   dataType: 'json',
   success: function(respuesta) {
    console.log("respuesta", respuesta);

    var fecha_venta = [];
    var total_venta = [];
    var total_venta_ant = [];
    var total_ventas_mes = 0;
				var date = new Date();

    for (let i = 0; i < respuesta.length; i++) {
     fecha_venta.push(respuesta[i]['fecha_venta']);
     total_venta.push(respuesta[i]['total_venta']);
     total_venta_ant.push(respuesta[i]['total_venta_ant']);
     total_ventas_mes = parseFloat(total_ventas_mes) + parseFloat(respuesta[i]['total_venta']);
    }

    total_venta.push(0);

    $("#card-titulo").html('VENTAS DEL MES: $ ' + total_ventas_mes.toFixed(1).toString().replace(/\d(?=(\d{3})+\.)/g, "$&,") + ' pesos colombianos');

    var barChartCanvas = $("#barChart").get(0).getContext('2d');
    var areaChartData = {
     labels: fecha_venta,
     datasets: [{
      label: 'VENTAS DEL MES ACTUAL',
      backgroundColor: 'rgba(60,141,188,0.9)',
      data: total_venta
     }]
    }

    var barChartData = $.extend(true, {}, areaChartData);
    var temp0 = areaChartData.datasets[0];
    barChartData.datasets[0] = temp0;

    var barChartOptions = {
     maintainAspectRatio: false,
     responsive: true,
     events: false,
     legend: {
      display: true
     },
     scales: {
      xAxes: [{
       stacked: true,
      }],
      yAxes: [{
       stacked: true
      }]
     },
     animation: {
      duration: 500,
      easing: "easeOutQuart",
      onComplete: function() {
       var ctx = this.chart.ctx;
       ctx.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontFamily, 'normal', Chart.defaults
        .global.defaultFontFamily);
       ctx.textAlign = 'center';
       ctx.textBaseline = 'bottom';
       this.data.datasets.forEach(function(dataset) {
        for (var i = 0; i < dataset.data.length; i++) {
         var model = dataset._meta[Object.keys(dataset._meta)[0]].data[i]._model,
          scale_max = dataset._meta[Object.keys(dataset._meta)[0]].data[i]._yScale.maxHeight;
         ctx.fillStyle = '#fff';
         var y_pos = model.y + 15;
         if ((scale_max - model.y) / scale_max >= 0.93)
          y_pos = model.y + 20;
         ctx.fillText(dataset.data[i], model.x, y_pos);
        }
       });
      }
     }
    }

    new Chart(barChartCanvas, {
     type: 'bar',
     data: barChartData,
     options: barChartOptions
    })
   }
  });
 }

 /* =======================================================
						SOLICITUD AJAX LISTADO PRODUCTOS MAS VENDIDOS
 ==========================================================*/
 function cargarProductosMasVendidos() {
  $.ajax({
   url: "ajax/dashboard.ajax.php",
   type: "POST",
   data: {
    'accion': 2 // Listar los 10 productos mas vendidos
   },
   dataType: 'json',
   success: function(respuesta) {
    console.log("respuesta", respuesta);
    for (let i = 0; i < respuesta.length; i++) {
     filas = '<tr>' +
      '<td>' + respuesta[i]["descripcion_producto"] + '</td>' +
      '<td class="text-center">' + respuesta[i]["cantidad"] + '</td>' +
      '<td class="text-center"> $ ' + respuesta[i]["total_venta"] + '</td>' +
      '</tr>'
     $("#tbl_productos_mas_vendidos tbody").append(filas);
    }
   }
  });
 }

 /* =======================================================
 	   			SOLICITUD AJAX LISTADO PRODUCTOS BAJO STOCK
 ==========================================================*/
 function cargarProductosPocoStock() {
  $.ajax({
   url: "ajax/dashboard.ajax.php",
   type: "POST",
   data: {
    'accion': 3 // Listar los 10 productos mas vendidos
   },
   dataType: 'json',
   success: function(respuesta) {
    console.log("respuesta", respuesta);
    for (let i = 0; i < respuesta.length; i++) {
     filas = '<tr>' +
      '<td>' + respuesta[i]["descripcion_producto"] + '</td>' +
      '<td class="text-center">' + respuesta[i]["stock_producto"] + '</td>' +
      '<td class="text-center">' + respuesta[i]["minimo_stock_producto"] + '</td>' +
      '</tr>'
     $("#tbl_productos_poco_stock tbody").append(filas);

    }
   }
  });
 }
</script>