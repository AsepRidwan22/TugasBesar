</div><!-- /#page-wrapper -->

    </div><!-- /#wrapper -->

    <!-- JavaScript -->
    <script src="../assets/js/jquery-1.10.2.js"></script>
    <script src="../assets/js/bootstrap.js"></script>
    <script src="../assets/dataTables/datatables.min.js"></script>

      <script type="text/javascript">
      $(document).on("click", "#edit_product", function(){
        var idprdc = $(this).data('id');
        var nm = $(this).data('name');
        var prce = $(this).data('price');
        var ctgr = $(this).data('category');
        var img = $(this).data('image');
        $("#modal-edit #id").val(idprdc);
        $("#modal-edit #name").val(nm);
        $("#modal-edit #price").val(prce);
        $("#modal-edit #category").val(ctgr);
        $("#modal-edit #pict").attr("src", "../upload/img_product/"+img);
        
      })
      $(document).ready(function(e){
        $("#form").on("submit", (function(e){
          e.preventDefault();
          $.ajax({
            url : '../models/proses_edit.php',
            type : 'POST',
            data : new FormData(this),
            contentType : false,
            cache : false,
            processData : false,
            success : function(msg){
              $('.table').html(msg);
            }
          });
        }));
      })
      $(document).ready( function () {
        $('#datatables').DataTable();
      });
      </script>
  </body>
</html>