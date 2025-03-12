<?php
$sql = "SELECT * FROM conference WHERE cse_id = " . $_SESSION['course']['cse_id'];
if ($result = mysqli_query($conn, $sql)) {
    if (!empty($result->num_rows) && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            ?>
            <li class='list-group-item mb-3 d-flex justify-content-between'>
                <div>
                    <a href="../conference/view_conference.php?conf_id=<?= $row['conf_id'] ?>" class='text-dark'><i
                            class='ri-draft-fill h5 me-1 align-middle'></i><?= $row['conf_name'] ?></a>
                </div>
                <div>
                    <i class='bi bi-camera-reels' title='Start'></i>
                    <a href='#'><i class='bi bi-pencil ms-3 text-dark' title='Edit' data-bs-toggle='modal'
                            data-bs-target='#conf_<?= $row['conf_id'] ?>'></i></a>

                    <div class='modal fade' id="conf_<?= $row['conf_id'] ?>" aria-hidden='true'>
                        <div class='modal-dialog modal-dialog-centered'>
                            <div class='modal-content'>
                                <div class='modal-header'>
                                    <h1 class='modal-title fs-5'>Update Conference</h1>
                                    <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                </div>
                                <div class='modal-body'>

                                    <form action="../conference/add_conf.php" id="conf_form" method="post">

                                        <div class="col-xl-12">
                                            <div class="row mb-3">
                                                <label class="col-md-3 col-form-label text-dark" for="">Title</label>
                                                <div class="col-md-9 mt-2">
                                                    <input type="text" class="form-control" id="conf_title" name="cName"
                                                        value="<?= $row['conf_name'] ?>">
                                                    <span class="text-danger err-msg" id="error-message-1"></span>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label class="col-md-3 col-form-label text-dark" for="">Description</label>
                                                <div class="col-md-9 mt-2">
                                                    <textarea type="text" class="form-control" id="conf_desc" col="70" row="5"
                                                        name="cDesc"><?= $row['conf_desc'] ?></textarea>
                                                    <span class="text-danger err-msg" id="error-message-2"></span>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label class="col-md-3 col-form-label text-dark" for="">Start Time</label>
                                                <div class="col-md-9">
                                                    <input type="datetime-local" class="form-control" id="conf_start_datetime"
                                                        name="sDateTime" value="<?= $row['conf_start_datetime'] ?>">
                                                    <span class="text-danger err-msg" id="error-message-3"></span>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label class="col-md-3 col-form-label text-dark" for="">End Time</label>
                                                <div class="col-md-9">
                                                    <input type="datetime-local" class="form-control" id="conf_end_datetime"
                                                        name="eDateTime" value="<?= $row['conf_end_datetime'] ?>">
                                                    <span class="text-danger err-msg" id="error-message-4"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class='modal-footer'>
                                    <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
                                    <button type='button' class='btn btn-primary'>Update</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <a href='#'><i class='bi bi-trash3 ms-3 text-dark' title='Delete' data-bs-toggle='modal' data-bs-target='#conf_del_<?= $row['conf_id'] ?>'>
                    </i></a>

                    <div class='modal fade' id="conf_del_<?= $row['conf_id'] ?>" aria-hidden='true'>
                        <div class='modal-dialog modal-dialog-centered'>
                            <div class='modal-content'>
                                <div class='modal-header'>
                                    <h1 class='modal-title fs-5'>Delete Conference</h1>
                                    <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                </div>
                                <form action="../conference/add_conf.php?delete" id="conf_form" method="post">
                                    <div class='modal-body'>
                                    
                                    <h3> Do you want to delete this conference? </h3>

                                    </div>
                                    <div class='modal-footer'>
                                        <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
                                        <button type='submit' class='btn btn-primary'>Delete</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
            <?php
        }
    } else {
        echo "<li class='list-group-item mb-3'>No Conferences are available</li>";
    }
}