<?php
include './includes/db.php'; 

session_start();
// getting the emails form inbox table from database

         $loginId  = $_SESSION['loginId'] ;
         $sql = "SELECT * FROM je_inbox where je_email_to_id= '$loginId' ";
                $result = $db -> query($sql);
                if($_GET['emailId']){
                    $emailId = $_GET['emailId'];
                    $sqlemail = "SELECT * FROM je_inbox where je_email_id= '$emailId' ";
                    $resultemail = $db -> query($sqlemail);

                    $resemail = $resultemail->fetch_assoc();
                    

                }
       
?>  
<!-- This code is referenced from bootstrap
https://getbootstrap.com/docs/4.0/components/modal/ -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Email</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form>
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">From:</label>
            <input type="text" value = "<?php echo $resemail['je_email_from_email']?>" disabled class="form-control">
          </div>
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Subject:</label>
            <input type="text" value = "<?php echo $resemail['je_email_subject'];?>" disabled class="form-control">
          </div>
          <div class="mb-3">
            <label for="message-text" class="col-form-label">Message:</label>
            <textarea class="form-control " rows="15" disabled id="message-text"><?php $data=  sanitizeData($resemail['je_email_content']); echo $data; ?></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
          <!--Creating table for the inbox emails 
          Table referenced from https://getbootstrap.com/docs/4.0/content/tables/ -->
        <div class="container " style="overflow-x:auto;" >
          <table class="table table-striped table-responsive" >
          <thead class="text-center">
              <tr>
              <th scope="col">Subject</th>
              <th scope="col">Email From</th>
              <th scope="col">Email Content</th>
              <th scope="col">Date received</th>
              </tr>
          </thead>
          <tbody>

    <?php
                  while ($res = $result->fetch_assoc()) {
            ?>
              
                      <tr class="text-center">
                        <?php $emailId = $res['je_email_id']?>
                        <th class="text-primary" type="button" id="<?php echo $emailId?>" onclick="window.location.href = 'index.php?emailId=<?php echo $emailId?>'" ><?php echo $res['je_email_subject']; ?></th>
                        <td scope="row"><?php echo $emailfrom = $res['je_email_from_email']; ?></td>
                        <!-- https://stackoverflow.com/questions/63009139/how-can-i-limit-the-length-of-characters-to-be-shown-in-the-table-td -->
                        <td   style="max-width:170px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis">
                        <!-- if the email is encrypted then it will show a flag to user. -->
                        <?php if($res['je_email_enc']==1){
                          ?> <p class=text-danger> this email is encrypted </p>
                      <?php } ?>
                          <?php  $emailId = $res['je_email_content']; echo sanitizeData($emailId);?></td>
                        <td ><?php echo $emailId = $res['je_date_received'];?></td>                   
                      </tr>
                  
                  <?php                
          }
  ?>
                      </tbody>

            </table>
        </div>


<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

<script>
    $(document).ready(function() {
// https://stackoverflow.com/questions/13183630/how-to-open-a-bootstrap-modal-window-using-jquery
        if(window.location.href.indexOf('emailId') != -1) {
            $('#exampleModal').modal('show');
        }

    });
  
</script>