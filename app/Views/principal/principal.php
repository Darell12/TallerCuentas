  <link rel="stylesheet" href="<?php echo base_url() ?>/css/heros.css">
  <!-- ======= Hero Section ======= -->
  <main class="bg-dark">
    <section id="hero" class="d-flex align-items-center">

      <div class="container">
        <div class="row">
          <div class="col-lg-6 d-flex flex-column justify-content-center pt-4 pt-lg-0 order-2 order-lg-1" data-aos="fade-up" data-aos-delay="200">
            <h1>SG - De Empleados: Administración de Salarios, Cargos y Ubicaciones</h1>
            <h2>Optimiza tu gestión de recursos humanos con nuestro sisterma de administración de empleados</h2>
          </div>
          <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-in" data-aos-delay="200">
            <img src="<?php echo base_url() ?>/img/hero-img.png" class="img-fluid animated" alt="">
          </div>
        </div>
      </div>

    </section>

    <div class="container row d-flex align-items-center">
      <div class="col-sm-6">
        <div class="card" data-bs-theme="dark">
          <div class="card-body">
            <h5 class="card-title text-center">Empleados</h5>
            <canvas id="chartEmpleados"></canvas>
          </div>
        </div>
      </div>
      <div class="col-sm-6">
        <div class="card" data-bs-theme="dark">
          <div class="card-body">
            <h5 class="card-title text-center">Residencias</h5>
            <canvas id="chartResidencia"></canvas>
          </div>
        </div>
      </div>
    </div>
  </main>


  <footer id="footer">


    <div class="container footer-bottom clearfix">
      <div class="copyright">
        &copy; Copyright <strong><span>ADSO-1</span></strong>. All Rights Reserved
      </div>
      <div class="credits"> <!-- All the links in the footer should remain intact. --> <!-- You can delete the links only if you purchased the pro version. --> <!-- Licensing information: https://bootstrapmade.com/license/ --> <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/arsha-free-bootstrap-html-template-corporate/ -->
        Diseñado por <a class="text-primary" href="https://github.com/Darell12/">Darell E.</a>
      </div>
    </div>
  </footer><!-- End Footer -->


  <script>
    // Interpretacion de estados
    posibles_estados = {
      'A': 'Activos',
      'E': 'Eliminados',
    }

    $.ajax({
      url: `<?php echo base_url('/empleados/total'); ?>`,
      dataType: 'json',
      success: function(empleados) {

        // crear el objeto de configuración del gráfico
        var estados = {
          'Total': empleados.length
        };
        estados['Total']
        empleados.forEach(function(empleado) {
          console.log(empleado.estado);
          if (estados[posibles_estados[empleado.estado]]) {
            estados[posibles_estados[empleado.estado]] += 1;
          } else {
            estados[posibles_estados[empleado.estado]] = 1;
          }
        });
        //console.log(estados)
        // Crear un conjunto de datos para cada estado
        var datos = {
          labels: Object.keys(estados),
          datasets: [{
            label: 'Empleados',
            data: estados,
            backgroundColor: [
              'rgba(255, 99, 132, 0.2)',
              'rgba(255, 159, 64, 0.2)',
              'rgba(255, 205, 86, 0.2)',
              'rgba(75, 192, 192, 0.2)',
              'rgba(54, 162, 235, 0.2)',
              'rgba(153, 102, 255, 0.2)',
              'rgba(201, 203, 207, 0.2)'
            ],
            borderColor: [
              'rgb(255, 99, 132)',
              'rgb(255, 159, 64)',
              'rgb(255, 205, 86)',
              'rgb(75, 192, 192)',
              'rgb(54, 162, 235)',
              'rgb(153, 102, 255)',
              'rgb(201, 203, 207)'
            ],
            borderWidth: 2
          }]
        };
        console.log(datos);
        // Configurar la gráfica
        var config = {
          // TYPE DEFINE EL TIPO DE FORMULARIO
          type: 'bar',
          data: datos,
          options: {
            responsive: true,
          },
          // plugins: [noData]
        };



        // Crear la gráfica
        var ctx = document.getElementById('chartEmpleados').getContext('2d');
        var chart = new Chart(ctx, config);

        // function click(chart, click) {

        //     let resetear_cordenadas = chart.canvas.getBoundingClientRect();
        //     let ejeX = click.clientX - resetear_cordenadas.left;
        //     let ejeY = click.clientY - resetear_cordenadas.top

        //     const {
        //         data,
        //         scales: {
        //             x: {
        //                 top,
        //                 bottom,
        //                 left,
        //                 height,
        //                 width,
        //                 ticks
        //             }
        //         }
        //     } = chart
        //     const right = width / ticks.length;

        //     let estados_inversos = {
        //         'Total': '',
        //         'Eliminados': 'E',
        //         'Activos': 'A',
        //     }

        //     for (let i = 0; i < ticks.length; i++) {
        //         if (ejeX >= left + (right * i) && ejeX <= left + right + (right * i) && ejeY >= top && ejeY <= bottom) {
        //             console.log(data.labels[i])

        //             if (data.labels[i] == 'Totales') {
        //                 window.location.replace(`<?php echo base_url('/cotizaciones') ?>`);
        //             } else {
        //                 window.location.replace(`<?php echo base_url('/cotizaciones/cotizacionesEstado') ?>/${estados_inversos[data.labels[i]]}`);
        //             }
        //         }
        //     }
        // }

        chart.canvas.addEventListener('click', (e) => {
          click(chart, e);
          chart.resize();
        })
      }
    });
  </script>
  <script>
    // Interpretacion de estados
    posibles_estados = {
      'A': 'Activos',
      'E': 'Eliminados',
    }

    $.ajax({
      url: `<?php echo base_url('/empleados/residencia'); ?>`,
      dataType: 'json',
      success: function(empleados) {

        // crear el objeto de configuración del gráfico
        var paises = {
          // 'Total': empleados.length
        };
        // paises['Total']
        empleados.forEach(function(empleado) {
          console.log(empleado.pais_nombre);
          if (paises[empleado.pais_nombre]) {
            paises[empleado.pais_nombre] += 1;
          } else {
            paises[empleado.pais_nombre] = 1;
          }
        });
        //console.log(estados)
        // Crear un conjunto de datos para cada estado
        var datos = {
          labels: Object.keys(paises),
          datasets: [{
            label: 'Empleados',
            data: paises,
            backgroundColor: [
              'rgba(255, 99, 132, 0.2)',
              'rgba(255, 159, 64, 0.2)',
              'rgba(255, 205, 86, 0.2)',
              'rgba(75, 192, 192, 0.2)',
              'rgba(54, 162, 235, 0.2)',
              'rgba(153, 102, 255, 0.2)',
              'rgba(201, 203, 207, 0.2)'
            ],
            borderColor: [
              'rgb(255, 99, 132)',
              'rgb(255, 159, 64)',
              'rgb(255, 205, 86)',
              'rgb(75, 192, 192)',
              'rgb(54, 162, 235)',
              'rgb(153, 102, 255)',
              'rgb(201, 203, 207)'
            ],
            borderWidth: 2
          }]
        };
        console.log(datos);
        // Configurar la gráfica
        var config = {
          // TYPE DEFINE EL TIPO DE FORMULARIO
          type: 'bar',
          data: datos,
          options: {
            responsive: true,
          },
          // plugins: [noData]
        };

        // Crear la gráfica
        var ctx = document.getElementById('chartResidencia').getContext('2d');
        var chart = new Chart(ctx, config);

        // function click(chart, click) {

        //     let resetear_cordenadas = chart.canvas.getBoundingClientRect();
        //     let ejeX = click.clientX - resetear_cordenadas.left;
        //     let ejeY = click.clientY - resetear_cordenadas.top

        //     const {
        //         data,
        //         scales: {
        //             x: {
        //                 top,
        //                 bottom,
        //                 left,
        //                 height,
        //                 width,
        //                 ticks
        //             }
        //         }
        //     } = chart
        //     const right = width / ticks.length;

        //     let estados_inversos = {
        //         'Total': '',
        //         'Eliminados': 'E',
        //         'Activos': 'A',
        //     }

        //     for (let i = 0; i < ticks.length; i++) {
        //         if (ejeX >= left + (right * i) && ejeX <= left + right + (right * i) && ejeY >= top && ejeY <= bottom) {
        //             console.log(data.labels[i])

        //             if (data.labels[i] == 'Totales') {
        //                 window.location.replace(`<?php echo base_url('/cotizaciones') ?>`);
        //             } else {
        //                 window.location.replace(`<?php echo base_url('/cotizaciones/cotizacionesEstado') ?>/${estados_inversos[data.labels[i]]}`);
        //             }
        //         }
        //     }
        // }

        chart.canvas.addEventListener('click', (e) => {
          click(chart, e);
          chart.resize();
        })
      }
    });
  </script>