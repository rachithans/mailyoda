<?php
include './includes/db.php'; 

session_start();

         $loginId  = $_SESSION['loginId'] ;
         $sql = "SELECT * FROM je_email_sentdrafts where je_sentdraft_from_id= '$loginId' ";
                $result = $db -> query($sql);
                if($_GET['sent/draftmail'] || $_GET['sent/draftmaildecrypt']){
                  if($_GET['sent/draftmaildecrypt']){
                    $emailId = $_GET['sent/draftmaildecrypt'];
                  }else{
                    $emailId = $_GET['sent/draftmail'];
                  }
                    
                    $sqlemail = "SELECT * FROM je_email_sentdrafts where je_sentdraft_id= '$emailId' ";
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
            <label for="recipient-name" class="col-form-label">To:</label>
            <input type="text" value = "<?php echo $resemail['je_sentdraft_to_email'];?>" disabled class="form-control">
          </div>
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Subject:</label>
            <input type="text" value = "<?php echo $resemail['je_sentdraft_subject'];?>" disabled class="form-control">
          </div>
          <div class="mb-3">
            <label for="message-text" class="col-form-label">Message:</label>
            <textarea class="form-control " rows="15" disabled id="message-text"><?php echo $data = $resemail['je_sentdraft_content']; echo sanitizeData($data);?></textarea>
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
        <table class="table  table-striped table-responsive" >
        <thead class="text-center">
            <tr>
            <th scope="col">Subject</th>
            <th scope="col">Email To</th>
            <th scope="col">Email Status</th>
            <th scope="col">Email Content</th>
            <th scope="col">Date received</th>
            
            </tr>
        </thead>
        <tbody>

  <?php
                while ($res = $result->fetch_assoc()) {
           ?>
                    <tr class="text-center">
                    <?php $emailId = $res['je_sentdraft_id']?>
                    <th class="col-1 text-primary" type="button" id="<?php echo $emailId?>" onclick="window.location.href = 'index.php?sent/draftmail=<?php echo $emailId?>'" ><?php echo $res['je_sentdraft_subject']; ?> </th>
                    <td scope="row" class="col-1"><?php echo $emailfrom = $res['je_sentdraft_to_email']; ?></td>
                    <td scope="row" class="col-1"><?php 
                      if( $res['je_sentdraft_draft']==0){
                        echo "sent";
                      }else{
                        echo "draft";
                      } ?>
                     </td>
                      <!-- https://stackoverflow.com/questions/63009139/how-can-i-limit-the-length-of-characters-to-be-shown-in-the-table-td -->
                    <td   style="max-width:170px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis"> <?php if($res['je_sentdraft_enc']==1){
                        ?> <p class=text-danger> this email is encrypted </p>
                           <!-- <button onclick="window.location.href = 'index.php?sent/draftmaildecrypt=<?php echo $emailId?>'"> Decrypt and View Message </button> -->
                     <?php } ?>
                      <?php  $emailId = $res['je_sentdraft_content'];echo sanitizeData($emailId);?></td>
                    <td class="col-2"><?php echo $emailId = $res['je_sentdraft_datetime'];?></td>                   
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

        if(window.location.href.indexOf('sent/draftmail') != -1 ) {
            $('#exampleModal').modal('show');
        }

    });
  
</script>