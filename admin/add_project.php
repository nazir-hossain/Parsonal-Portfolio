<?php 
$page_title = 'Add New Project';
include 'partials/header.php'; 
?>

<h1>Add New Project</h1>

<form action="project_handler.php?action=add" method="POST">
    
    <label>Title (English)</label>
    <input type="text" name="title_en" required>

    <label>Title (Bengali)</label>
    <input type="text" name="title_bn" required>

    <label>Category</label>
    <select name="category" required>
        <option value="project">Project</option>
        <option value="research">Research</option>
        <option value="book">Book</option>
        <option value="php">PHP</option>
        <option value="javascript">JavaScript</option>
        <option value="react">React</option>
    </select>

    <label>Short Description (English)</label>
    <textarea name="short_desc_en" rows="3" required></textarea>

    <label>Short Description (Bengali)</label>
    <textarea name="short_desc_bn" rows="3" required></textarea>

    <label>Long Description (English)</label>
    <textarea name="long_desc_en" rows="10"></textarea>

    <label>Long Description (Bengali)</label>
    <textarea name="long_desc_bn" rows="10"></textarea>

    <label>Technologies</label>
    <input type="text" name="technologies">

    <label>Main Image URL</label>
    <input type="text" name="main_image">

    <label>Live Link</label>
    <input type="text" name="live_link">

    <label>Source Code Link</label>
    <input type="text" name="source_code">

    <label>Download File Path</label>
    <input type="text" name="download_file">

    <button type="submit">Submit</button>
</form>

<?php include 'partials/footer.php'; ?>