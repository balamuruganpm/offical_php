</div>
</div>

<!-- /#wrapper -->
<!-- jquer cdn link -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- GLOBAL SCRIPTS -->
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/plugins/bootstrap/bootstrap.min.js"></script>
<script src="assets/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<script src="assets/js/plugins/popupoverlay/jquery.popupoverlay.js"></script>
<!-- <script src="assets/js/plugins/popupoverlay/defaults.js"></script> -->


<!--  -->

<!--  -->



<!-- Logout Notification Box -->
<div id="logout">
    <div class="logout-message">
        <img class="img-circle img-logout" src="#" alt="">
        <h3>
            <i class="fa fa-sign-out text-green"></i> Ready to go?
        </h3>
        <p>Select "Logout" below if you are ready<br>to end your current session.</p>
        <ul class="list-inline">
            <li>
                <a href="logout.php" class="btn btn-green">
                    <strong>Logout</strong>
                </a>
            </li>
            <li>
                <button class="logout_close btn btn-green">Cancel</button>
            </li>
        </ul>
    </div>
</div>
<!-- /#logout -->



<!-- Logout Notification jQuery -->
<script src="assets/js/plugins/popupoverlay/logout.js"></script>
<!-- HISRC Retina Images -->
<script src="assets/js/plugins/hisrc/hisrc.js"></script>

<!-- PAGE LEVEL PLUGIN SCRIPTS -->
<!-- HubSpot Messenger -->
<!-- <script src="assets/js/plugins/messenger/messenger.min.js"></script> -->
<script src="assets/js/plugins/messenger/messenger-theme-flat.js"></script>
<!-- Date Range Picker -->
<script src="assets/js/plugins/daterangepicker/moment.js"></script>
<script src="assets/js/plugins/daterangepicker/daterangepicker.js"></script>

<!-- DataTables -->
<script src="assets/js/plugins/datatables/jquery.dataTables.js"></script>
<script src="assets/js/plugins/datatables/datatables-bs3.js"></script>

<!-- THEME SCRIPTS -->
<script src="assets/js/flex.js"></script>
<!-- <script src="assets/js/demo/dashboard-demo.js"></script> -->
<script src="assets/js/demo/advanced-tables-demo.js"></script>
<!-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


<!-- own scripts start -->

<!-- addUserValidation -->
<script src="addUserValidation.js"></script>


<!-- own scripts ends here -->


<!-- sweet alert -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<!-- CKEditor -->
<script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/classic/ckeditor.js"></script>




<!-- dataTable dom cdn link -->
<!-- DataTables -->
<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.colVis.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>

<!-- bulkupload -->
<!-- <script src="https://cdn.jsdelivr.net/npm/d3@7"></script> -->


<script>
    $(document).ready(function() {
        // Initialize DataTable
        $('#user-table').DataTable({
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'csv',
                    className: 'btn btn-primary',
                    text: '<i class="fa-solid fa-download"></i> CSV ',
                    title:'user_report',
                    titleAttr: 'DownLoad as CSV File',
                },
                {
                    extend: 'excel',
                    className: 'btn btn-primary',
                    text: '<i class="fa-solid fa-download"></i> Excel',
                    title:'user_report',
                    titleAttr:'Download as Excel File',
                },
                {
                    extend: 'pdf',
                    className: 'btn btn-primary',
                    text: '<i class="fa-solid fa-download"></i> PDF',
                    title:'user_report',
                    titleAttr:'Download as PDF File',
                },
                {
                    extend: 'print',
                    className: 'btn btn-primary',
                    text: '<i class="fa-solid fa-download"></i> Print',
                    title:'user_report',
                    titleAttr:'Print User reports',
                },

            ]
        });


        $('.payment_table').DataTable({
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'csv',
                    className: 'btn btn-primary',
                    text: '<i class="fa-solid fa-download"></i> CSV ',
                    title:'payment_report',
                    titleAttr: 'DownLoad as CSV File',
                },
                {
                    extend: 'excel',
                    className: 'btn btn-primary',
                    text: '<i class="fa-solid fa-download"></i> Excel',
                    title:'payment_report',
                    titleAttr:'Download as Excel File',
                },
                {
                    extend: 'pdf',
                    className: 'btn btn-primary',
                    text: '<i class="fa-solid fa-download"></i> PDF',
                    title:'payment_report',
                    titleAttr:'Download as PDF File',
                },
                {
                    extend: 'print',
                    className: 'btn btn-primary',
                    text: '<i class="fa-solid fa-download"></i> Print',
                    title:'payment_report',
                    titleAttr:'Print User reports',
                },

            ]
        });




        $('#withdra-table').DataTable({
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'csv',
                    className: 'btn btn-primary',
                    text: '<i class="fa-solid fa-download"></i> CSV ',
                    title:'withdraw_report',
                    titleAttr: 'DownLoad as CSV File',
                },
                {
                    extend: 'excel',
                    className: 'btn btn-primary',
                    text: '<i class="fa-solid fa-download"></i> Excel',
                    title:'withdraw_report',
                    titleAttr:'Download as Excel File',
                },
                {
                    extend: 'pdf',
                    className: 'btn btn-primary',
                    text: '<i class="fa-solid fa-download"></i> PDF',
                    title:'withdraw_report',
                    titleAttr:'Download as PDF File',
                },
                {
                    extend: 'print',
                    className: 'btn btn-primary',
                    text: '<i class="fa-solid fa-download"></i> Print',
                    title:'withdraw_report',
                    titleAttr:'Print User reports',
                },

            ]
        });
    });

   
    </script>



</body>


</html>

