  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="/assets/js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="/assets/js/bootstrap.min.js"></script>
    <script src="/assets/js/jasny-bootstrap.min.js"></script>
    <script src="/assets/jqueryui/jquery-ui.min.js"></script>
    
  <script>
    $(function() {
      $("input[name=term]").autocomplete({
        source: "{{route('contacts.autocomplete')}}",
        minLength: 3,
        select: function(event, ui) {
        $(this).val(ui.item.value);
        }
      });
    });
  </script>
    <!-- <script src="/assets/js/jasny-bootstrap.min.js"></script>
    <script src="/assets/jqueryui/jquery-ui.min.js"></script> -->
    <!-- <script>
      $(function() {
        $("#term").autocomplete({
          source: "",
          minLength: 3,
          select: function(event, ui) {
            $("#term").val(ui.item.value);
          }
        });
      });
    </script> -->
    @yield('form-script')