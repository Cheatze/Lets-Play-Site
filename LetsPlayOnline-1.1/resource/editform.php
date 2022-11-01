<div class="container">
    <h5>If you do not give an input it will stay the same in the database</h5>

    <form name="gamer" method="POST" onsubmit="return validateForm()" enctype="multipart/form-data">

    <div class="form-group ml-20px">
        <label for="exampleInputEmail1">Name</label>
        <?php
            echo "<input type='text' name='name' class='form-control' aria-describedby='emailHelp' value='$name'>";
        ?>
    </div>

    <div class="form-group">
        <label for="exampleInputUsername1">Players</label>
        <?php
            //<input type="number" class="form-control w-25 p-3" name="players" min="1" max="12" required>
           echo "<input type='number' class='form-control w-25 p-3' name='players' min='1' max='12' required value='$players'>";
        ?>
    </div>
    
    <div class="form-group">
        <label for="exampleInputDescription">Description (optional)</label>
        <textarea name="description" rows="5" cols="30"></textarea>
    </div>

    <div class="form-group">
        <label for="exampleInputPassword1">Select image to upload: (optional)</label>
        <input type="file" name="fileToUpload" class="form-control" id="fileToUpload" placeholder="">
    </div>

    <button type="submit" name="editbtn" value="insertBtn"  class="btn btn-primary">Submit</button>

    </form>

</div>

<hr>

<div class="container">
    <h3>Delete</h3>
    <form name="delete" method="post" action="">
    <button type="submit" name="deletebtn" value="del" lass="btn btn-primary" onclick="return confirm('Are you sure you want to delete?')">Delete entry</button>
    </form>
</div>