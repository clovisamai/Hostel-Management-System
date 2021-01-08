<div class="modal fade" id="complaint" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body bg-light">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h3 class="px-3">Complaint</h3>
                <div>
                    <div class="container">
                        <?php if(isset($_SESSION['role']) && $_SESSION['role'] == 3 && isset($_SESSION['user'])){ ?>
                        <form action="funcs/" method="post">
                            <input hidden name="userID" value="<?php echo  $_SESSION['user_id']; ?>">
                                                            
                            <div class="form-group">
                                <textarea name="message" rows="5" class="form-control" required></textarea>
                            </div>
                            <button type="reset" class="btn btn-warning">Reset</button>
                            <button type="submit" class="btn btn-dark">Send Complaint</button>
                        </form>
                        <?php }else{ ?>
                        <h5 class="p-4 text-warning">You are required to login in order to make an inquiry</h5>
                        <?php } ?> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>