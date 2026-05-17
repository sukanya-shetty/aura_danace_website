<?php
require 'config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous"/>
    <link rel="stylesheet" href="adminstyle.css" type="text/css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <style>
        #menu .items li:nth-child(2){
              border-left: 4px solid #fff;
        }

        #interface .navigation{
    display: flex;
    align-items: center;
    justify-content: space-between;
    background: #fff;
    padding: 3px 30px;
    border-bottom: 3px solid #594ef7;
    position: fixed;
    width: 80%;
        }

        button{
    background: #7B74EC;
    margin-right: 10px;
    padding: 5px 10px 5px 10px;
    border-radius: 12px;
    height: 30px;
    display: flex;
    justify-content: center;
    align-items: center;
}
   a{
    font-size: 14px;
   }

   @media(max-width:769px) {
    #menu {
        width: 250px;
        position: fixed;
        left: -270px;
        transition: 0.3s ease;
    }

    #menu.active{
        left: 0px;
    }

    #menu-btn{
        display: initial;
    }

    #interface {
        width: 100%;
        margin-left: 0px;
        display: inline-block;
        transition: 0.3s ease;
    }
    
    #menu.active~#interface{
        width:calc(100%-250px);
        margin-left: 270px;
        transition: 0.3s ease;
    }

    #interface .navigation {
        width: 100%;
    }

    .values {
        padding: 30px 30px 0 30px;
        justify-content: flex-start;
    }

    .values .val-box {
        padding: 16px 20px;
        margin: 10px 20px 10px 0;
    }
}

input{
width:400px;
background:white;
border:none;
border-radius:3px;
margin-left: 15px;
}

textarea{
  border-radius:3px;
  margin-left: 15px;
}

.butto{
    font-size: 16px;
    border: none;
    outline: none;
    background: #ADA1E6;
    padding: 5px;
    margin-top: 40px;
    margin-left: 150px;
    border-radius: 90px;
    font-weight: 300;
    cursor: pointer;
    width: 200px;
}

span{
    margin-left: 15px;
    font-weight: bolder;
}

    </style>
    
    <?php
    session_start();
    //if(!isset($_SESSION['uname'])){
     //   header("Location:ww.html");
    //}
    //exit;
    //$name=$_SESSION['uname'];
    ?>
</head>
<body>
    <section id=menu>
        <div class="logo">
            <img src="logo-removebg-preview.png" alt="download-removebg-preview">
        </div>

        <div class="items">
            <li><i class="fas fa-th-large"></i>            
            <a href="adminpanel.php">Dashboard</a></li>
            <li><i class="fas fa-solid fa-music"></i><a href="#">Dance Forms</a></li>
            <li><i class="fas fa-user-graduate"></i><a href="student.php">Students</a></li>
            <li><i class="fas fa-calendar"></i><a href="eventss.php">Events</a></li>
            <li><i class="fas fa-hand-holding-usd"></i><a href="earnings.php">Earnings</a></li>
        </div>
    </section>

    <section id="interface">
        <div class="navigation">
            <div class="n1">
                <div>
                    <i id="menu-btn" class="fas fa-bars"></i>
                </div>
                <div class="ad">Welcome , &nbsp;<?php echo "<h5 style='color:#ADA1E6;'>$_SESSION[uname]</h3>"?></div>
            </div>

            <div class="profile">
            <button name="logout"><a href="ww.html" style="text-decoration: none; color:#fff;">Logout</a></button>
             &nbsp;&nbsp;&nbsp;   <img src="admin/uimage.png" alt="uimage">
                
            </div>
        </div>

        <h3 class="i-name">Menu</h3>
        <div class="values">
           <!-- Button trigger modal -->

<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
  Add Category for adults
</button>

<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">
  Add Dance Forms for adults
</button>

<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#viewCategoriesModal">
  View Categories
</button>

<!-- Modal -->
<div class="modal-dialog modal-lg">
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
<div class="modal-dialog modal-lg">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Add Category for Adults</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="post" action="addc.php" style="background: #e8dada; height: 350px;">
            <br><span> Dance Category</span><br>
            <input type="text" name="categ" required>
            <br><br>
            <span>Add a little context</span><br>
             <textarea name="context" rows="4" cols="50" required></textarea><br>
            <input type="submit" value="Add Category" name="cat" class="butto">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
</div>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Add Dance Forms</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body"><br>
        <form action="addf.php" method="post" style="background: #e8dada; height:450px">
           <br><span>Enter the dance category under which to add</span> <br>
            <input type="text" name="cat" required>
            <br><br>
            <span>Enter the dance form</span><br>
            <input type="text" name="form" required><br><br>
            <span>Enter the amount</span><br>
            <input type="text" name="amt" required><br><br>
            <span>Enter the Duration</span><br>
            <input type="text" name="dur" required><br><br>
            <span>Enter a little context</span><br>
            <textarea name="con" rows="2" cols="50" required></textarea><br><br>
            <input type="submit" name="addform" value="Add" class="butto">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<!-- View Categories Modal -->
<div class="modal fade" id="viewCategoriesModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="viewCategoriesLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="viewCategoriesLabel">Manage Categories & Courses</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div style="max-height: 500px; overflow-y: auto;">
          <?php
            $sqlCat = "SELECT * FROM category ORDER BY cat ASC";
            $resultCat = $conn->query($sqlCat);
            if($resultCat && $resultCat->num_rows > 0) {
              while($rowCat = $resultCat->fetch_assoc()) {
                $catId = $rowCat['cat_id'];
                $catName = $rowCat['cat'];
                $catContext = $rowCat['context'];
                echo "
                <div style='border: 1px solid #ddd; padding: 15px; margin-bottom: 15px; border-radius: 5px;'>
                  <div style='display: flex; justify-content: space-between; align-items: center;'>
                    <div>
                      <h6 style='margin: 0; font-weight: bold;'>$catName</h6>
                      <small style='color: #666;'>$catContext</small>
                    </div>
                    <div>
                      <button class='btn btn-sm btn-warning' onclick=\"editCategory($catId, '$catName')\">
                        <i class='fas fa-edit'></i> Edit
                      </button>
                      <button class='btn btn-sm btn-danger' onclick=\"deleteCategory($catId)\">
                        <i class='fas fa-trash'></i> Delete
                      </button>
                    </div>
                  </div>
                  
                  <hr style='margin: 10px 0;'>
                  
                  <h6 style='margin-top: 10px;'>Courses in this Category:</h6>
                  <table class='table table-sm table-striped'>
                    <thead>
                      <tr>
                        <th>Course Name</th>
                        <th>Instructor</th>
                        <th>Duration</th>
                        <th>Fee</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody>";
                
                // Get courses for this category
                $sqlCourse = "SELECT * FROM courses WHERE category='$catName' ORDER BY course_name ASC";
                $resultCourse = $conn->query($sqlCourse);
                if($resultCourse && $resultCourse->num_rows > 0) {
                  while($rowCourse = $resultCourse->fetch_assoc()) {
                    $courseId = $rowCourse['course_id'];
                    $courseName = $rowCourse['course_name'];
                    $instructor = $rowCourse['instructor_name'];
                    $duration = $rowCourse['duration'];
                    $fee = $rowCourse['fee'];
                    echo "
                    <tr>
                      <td>$courseName</td>
                      <td>$instructor</td>
                      <td>$duration</td>
                      <td>₹$fee</td>
                      <td>
                        <button class='btn btn-xs btn-warning' style='padding: 2px 5px; font-size: 11px;' onclick=\"editCourse($courseId, '$courseName')\">
                          <i class='fas fa-edit'></i> Edit
                        </button>
                        <button class='btn btn-xs btn-danger' style='padding: 2px 5px; font-size: 11px;' onclick=\"deleteCourse($courseId)\">
                          <i class='fas fa-trash'></i> Delete
                        </button>
                      </td>
                    </tr>";
                  }
                } else {
                  echo "<tr><td colspan='5' style='text-align: center; color: #999;'>No courses in this category</td></tr>";
                }
                echo "
                    </tbody>
                  </table>
                </div>";
              }
            } else {
              echo "<div style='text-align: center; color: #999;'>No categories found</div>";
            }
          ?>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Edit Category Modal -->
<div class="modal fade" id="editCategoryModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editCategoryLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editCategoryLabel">Edit Category</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="editCategoryForm" method="post" action="editcategory.php">
          <input type="hidden" id="editCatId" name="cat_id">
          <div class="mb-3">
            <label for="editCatName" class="form-label">Category Name</label>
            <input type="text" class="form-control" id="editCatName" name="categ" required>
          </div>
          <div class="mb-3">
            <label for="editCatContext" class="form-label">Context</label>
            <textarea class="form-control" id="editCatContext" name="context" rows="3" required></textarea>
          </div>
          <button type="submit" class="btn btn-primary">Update Category</button>
        </form>
      </div>
    </div>
  </div>
</div>


<!-- Edit Course Modal -->
<div class="modal fade" id="editCourseModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editCourseLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editCourseLabel">Edit Course</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="editCourseForm" method="post" action="editcourse.php">
          <input type="hidden" id="editCourseId" name="course_id">
          <div class="mb-3">
            <label for="editCourseName" class="form-label">Course Name</label>
            <input type="text" class="form-control" id="editCourseName" name="course_name" required>
          </div>
          <div class="mb-3">
            <label for="editInstructor" class="form-label">Instructor Name</label>
            <input type="text" class="form-control" id="editInstructor" name="instructor_name" required>
          </div>
          <div class="mb-3">
            <label for="editDuration" class="form-label">Duration</label>
            <input type="text" class="form-control" id="editDuration" name="duration" required>
          </div>
          <div class="mb-3">
            <label for="editFee" class="form-label">Fee (₹)</label>
            <input type="number" class="form-control" id="editFee" name="fee" required>
          </div>
          <button type="submit" class="btn btn-primary">Update Course</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
function editCategory(catId, catName) {
  document.getElementById('editCatId').value = catId;
  document.getElementById('editCatName').value = catName;
  var editModal = new bootstrap.Modal(document.getElementById('editCategoryModal'));
  editModal.show();
}

function deleteCategory(catId) {
  if(confirm('Are you sure you want to delete this category?')) {
    window.location.href = 'deletecategory.php?cat_id=' + catId;
  }
}

function editCourse(courseId, courseName) {
  document.getElementById('editCourseId').value = courseId;
  document.getElementById('editCourseName').value = courseName;
  
  // Fetch full course details via AJAX
  fetch('getCourseDetails.php?course_id=' + courseId)
    .then(response => response.json())
    .then(data => {
      document.getElementById('editInstructor').value = data.instructor_name;
      document.getElementById('editDuration').value = data.duration;
      document.getElementById('editFee').value = data.fee;
      var editModal = new bootstrap.Modal(document.getElementById('editCourseModal'));
      editModal.show();
    })
    .catch(error => console.error('Error:', error));
}

function deleteCourse(courseId) {
  if(confirm('Are you sure you want to delete this course?')) {
    window.location.href = 'deletecourse.php?course_id=' + courseId;
  }
}
</script>

        </div>
    </section>
</body>
</html>