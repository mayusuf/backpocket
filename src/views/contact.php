<h1>Contact Us </h1>
<h2>Welcome <?php echo $name; ?> </h2>

<form action="" method="POST">
  <div class="mb-3">
    <label  class="form-label">Name</label>
    <input type="text" class="form-control" name="name">
    
  </div>
  <!-- <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Password</label>
    <input type="password" class="form-control" id="exampleInputPassword1">
  </div> -->
  
  <button type="submit" name="submit" class="btn btn-primary">Submit</button>
</form>