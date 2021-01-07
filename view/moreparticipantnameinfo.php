<?php

require_once '../db/dbconfig.php';
$db = new Database();
if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $stmt_view = $db->dbConnection()->prepare('SELECT activity.*, organization.*, acttype.*, mainorg.*
                                   FROM activity 
                                   JOIN organization ON organization.orgtionNo = activity.actOrgtion
                                   JOIN acttype ON acttype.acttypeNo = activity.actType
                                   JOIN mainorg ON mainorg.mainorgNo = activity.actMainorg 
                                   WHERE activity.actID=:actID');
    $stmt_view->execute(array(':actID' => $id));
    $view_row = $stmt_view->fetch(PDO::FETCH_ASSOC);
    extract($view_row);
}
?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body ">
                <table id="tbactreg1" class="table table-hover table-striped text-left" cellspacing="0" width="100%">
                    <thead>
                        <tr style="color:#417d19;">
                            <th>รหัสนักศึกษา</th>
                            <th>ชื่อ-สกุล</th>
                            <th>สาขา</th>
                            <th>สถานะ</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $stmt = $db->dbConnection()->prepare("SELECT activity.*, student.*, organization.*,actregister.*  FROM actregister
                                        JOIN student ON student.stdID = actregister.actregstdID
                                        JOIN organization ON organization.orgtionNo = student.stdOrgtion
                                        JOIN activity ON activity.actID = actregister.actregactID
                                        WHERE actregister.actregactID='$id' && actregister.actregStatus='ยืนยันเรียบร้อย'
                                        ORDER BY actregister.actregNo DESC
                                          ");
                        $stmt->execute();
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        ?>
                            <tr>
                                <td><?php echo $row['stdID']; ?></td>
                                <td><?php echo $row['stdName']; ?></td>
                                <td><?php echo $row['organization']; ?></td>
                                <td><?php echo $row['actregStatus']; ?></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(function() {
        $('#tbactreg1').DataTable({
            pageLength: 10,
            "scrollX": true
            //"ajax": './assets/demo/data/table_data.json',
            /*"columns": [
                { "data": "name" },
                { "data": "office" },
                { "data": "extn" },
                { "data": "start_date" },
                { "data": "salary" }
            ]*/
        });
    })
    $('#ex-phone').mask('(999) 999-9999');
    $("#form-sample-1").validate({
        rules: {
            name: {
                minlength: 2,
                required: !0
            },
            email: {
                required: !0,
                email: !0
            },
            url: {
                required: !0,
                url: !0
            },
            number: {
                required: !0,
                number: !0
            },
            min: {
                required: !0,
                minlength: 3
            },
            max: {
                required: !0,
                maxlength: 4
            },
            password: {
                required: !0
            },
            password_confirmation: {
                required: !0,
                equalTo: "#password"
            }
        },
        errorClass: "help-block error",
        highlight: function(e) {
            $(e).closest(".form-group.row").addClass("has-error")
        },
        unhighlight: function(e) {
            $(e).closest(".form-group.row").removeClass("has-error")
        },
    });
</script>