<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<section class="section">
  <div class="row">

    <!-- Area Chart -->
    <div class="col-lg-6">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Area Chart - Status Transaksi</h5>
          <div id="areaChart"></div>
          <script>
            document.addEventListener("DOMContentLoaded", () => {
              new ApexCharts(document.querySelector("#areaChart"), {
                series: <?= $series ?>,
                chart: {
                  type: 'area',
                  height: 350,
                },
                xaxis: {
                  categories: <?= $labels ?>,
                  type: 'category'
                }
              }).render();
            });
          </script>
        </div>
      </div>
    </div>

    <!-- Line Chart -->
    <div class="col-lg-6">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Line Chart - Status Transaksi</h5>
          <div id="lineChart"></div>
          <script>
            document.addEventListener("DOMContentLoaded", () => {
              new ApexCharts(document.querySelector("#lineChart"), {
                series: <?= $series ?>,
                chart: {
                  height: 350,
                  type: 'line',
                  zoom: { enabled: false }
                },
                xaxis: {
                  categories: <?= $labels ?>,
                  type: 'category'
                }
              }).render();
            });
          </script>
        </div>
      </div>
    </div>

    <!-- Polar Area Chart -->
    <div class="col-lg-6">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Polar Area Chart - Total Transaksi per Status</h5>
          <div id="polarAreaChart"></div>
          <script>
            document.addEventListener("DOMContentLoaded", () => {
              const data = <?= $series ?>;
              const polarSeries = data.map(item => item.data.reduce((a, b) => a + b, 0));
              const polarLabels = data.map(item => item.name);

              new ApexCharts(document.querySelector("#polarAreaChart"), {
                series: polarSeries,
                chart: {
                  type: 'polarArea',
                  height: 350
                },
                labels: polarLabels,
                fill: { opacity: 0.8 },
                stroke: { colors: ['#fff'] }
              }).render();
            });
          </script>
        </div>
      </div>
    </div>

  </div>
</section>

<?= $this->endSection() ?>
