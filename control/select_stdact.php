
<div class="card-header" style="background-color:#d1cbaf">
            <h5 style="color:#2c2c2c">ตารางรายชื่อนักศึกษา</h5>
          </div>
          <div class="card-body text-nowrap">
            <table id="tb1" class="table table-hover-sm table-striped text-center" cellspacing="0" width="100%">
              <thead>
                <tr style="color:#528124;">
                  <th>ปีที่เข้าศึกษา</th>
                  <th>รหัสนักศึกษา</th>
                  <th>ชื่อ-สกุล</th>
                  <th>สาขา</th>
                  <th>กลุ่ม</th>
                  <th>สถานะ</th>
                  <th>ตรวจสอบ</th>
                </tr>
              </thead>
              <tbody>
                <?php
                require_once '../db/dbconfig.php';
                $db = new Database();
                $stmt = $db->dbConnection()->prepare("SELECT student.*, organization.*, mainorg.* FROM student 
                                                            JOIN organization ON student.stdOrgtion = organization.orgtionNo
                                                            JOIN mainorg ON student.stdMainorg = mainorg.mainorgNo
                                                            WHERE student.stdID='" . $_POST["stdID"] . "' ");
                $stmt->execute();
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                
                ?>
                  <tr>
                    <td><?php echo $row['stdYear']; ?></td>
                    <td><a href="" data-toggle="modal" data-target="#modalmoreinfo" data-id="<?php echo $row['stdID']; ?>" id="moreinfo"><?php echo $row['stdID']; ?></a></td>
                    <td><?php echo $row['stdName']; ?></td>
                    <td><?php echo $row['organization']; ?></td>
                    <td><?php echo $row['stdGroup']; ?></td>
                    <td><?php echo $row['stdStatus']; ?></td>
                    <td>
                      <a class="btn btn-sm btn-info" href="organizer_activity_participant.php?stdUser=<?php echo $row['stdID']; ?>">ตรวจสอบการเข้าร่วมกิจกรรม</a>
                    </td>
                  </tr>
                <?php
                }
                ?>
              </tbody>
            </table>
          </div>
          <div class="modal fade" id="modalmoreinfo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
              <div class="modal-content ">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLongTitle" style="color:#528124;">รายละเอียดเพิ่มเติม</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div id="modal-loader" style="text-align: center; display: none;">
                  </div>
                  <div id="dynamic-content">

                  </div>
                </div>
              </div>
            </div>
          </div>