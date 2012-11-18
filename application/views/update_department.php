<div class="add-alumni">
    <?php if ($success==1) { ?>
        <div style="color:white;background:green;">
          This post has been updated </div> 
     <?php } ?>
    <form action="<?=base_url()?>index.php/admin/department/<?=$valid_department['id'] ?>" method="post"> 
        <label for="department">
        Department: <input type="text" name="department" value="<?=$valid_department['department'] ?>">
        </label>
    
        <input type="submit" class="btn" value="Update Department">
    </form>
</div>
