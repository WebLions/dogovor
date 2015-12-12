    <?php echo link_tag('bootstrap/js/jquery.js').'<br>';?>
    <?php echo link_tag('bootstrap/js/jquery-ui-1.10.4.min.js').'<br>';?>
    <?php echo link_tag('bootstrap/js/jquery-1.8.3.min.js').'<br>';?>
    <?php echo link_tag('bootstrap/js/jquery-ui-1.9.2.custom.min.js').'<br>';?>
    <?php echo link_tag('bootstrap/js/bootstrap.min.js').'<br>';?>
    <?php echo link_tag('bootstrap/js/jquery.scrollTo.min.js').'<br>';?>
    <?php echo link_tag('bootstrap/js/jquery.nicescroll.js').'<br>';?>
    <?php echo link_tag('bootstrap/js/jquery.sparkline.js').'<br>';?>
    <?php echo link_tag('bootstrap/js/owl.carousel.js').'<br>';?>
    <?php echo link_tag('bootstrap/js/fullcalendar.min.js').'<br>';?>
    <?php echo link_tag('bootstrap/js/calendar-custom.js').'<br>';?>
    <?php echo link_tag('bootstrap/js/jquery.rateit.min.js').'<br>';?>
    <?php echo link_tag('bootstrap/js/jquery.customSelect.min.js').'<br>';?>
    <?php echo link_tag('bootstrap/js/scripts.js').'<br>';?>
    <?php echo link_tag('bootstrap/js/sparkline-chart.js').'<br>';?>
    <?php echo link_tag('bootstrap/js/easy-pie-chart.js').'<br>';?>
    <?php echo link_tag('bootstrap/js/jquery-jvectormap-1.2.2.min.js').'<br>';?>
    <?php echo link_tag('bootstrap/js/jquery-jvectormap-world-mill-en.js').'<br>';?>
    <?php echo link_tag('bootstrap/js/xcharts.min.js').'<br>';?>
    <?php echo link_tag('bootstrap/js/jquery.autosize.min.js').'<br>';?>
    <?php echo link_tag('bootstrap/js/jquery.placeholder.min.js').'<br>';?>
    <?php echo link_tag('bootstrap/js/gdp-data.js').'<br>';?>
    <?php echo link_tag('bootstrap/js/morris.min.js').'<br>';?>
    <?php echo link_tag('bootstrap/js/sparklines.js').'<br>';?>
    <?php echo link_tag('bootstrap/js/charts.js').'<br>';?>
    <?php echo link_tag('bootstrap/js/jquery.knob').'<br>';?>
    <?php echo link_tag('bootstrap/js/jquery.slimscroll.min.js').'<br>';?>


  <script>

      //knob
      $(function() {
        $(".knob").knob({
          'draw' : function () { 
            $(this.i).val(this.cv + '%')
          }
        })
      });

      //carousel
      $(document).ready(function() {
          $("#owl-slider").owlCarousel({
              navigation : true,
              slideSpeed : 300,
              paginationSpeed : 400,
              singleItem : true

          });
      });

      //custom select box

      $(function(){
          $('select.styled').customSelect();
      });
      
      /* ---------- Map ---------- */
    $(function(){
      $('#map').vectorMap({
        map: 'world_mill_en',
        series: {
          regions: [{
            values: gdpData,
            scale: ['#000', '#000'],
            normalizeFunction: 'polynomial'
          }]
        },
        backgroundColor: '#eef3f7',
        onLabelShow: function(e, el, code){
          el.html(el.html()+' (GDP - '+gdpData[code]+')').'<br>';
        }
      });
    });



  </script>

  </body>
</html>
