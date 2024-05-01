<?php
$page_title = 'Add Group';
require_once ('includes/load.php');
// Checking user permissions to view this page
page_require_level(1);

if (isset($_POST['add_group'])) {
    $req_fields = array('group-name', 'group-level');
    validate_fields($req_fields);

    if (find_by_groupName($_POST['group-name']) === false) {
        $session->msg('d', '<b>Error:</b> The entered group name already exists in the database.');
        redirect('manage_groups.php', false);
    } elseif (find_by_groupLevel($_POST['group-level']) === false) {
        $session->msg('d', '<b>Error:</b> The entered group level already exists in the database.');
        redirect('manage_groups.php', false);
    }

    if (empty($errors)) {
        $name = remove_junk($db->escape($_POST['group-name']));
        $level = remove_junk($db->escape($_POST['group-level']));
        $status = remove_junk($db->escape($_POST['status']));

        $query = "INSERT INTO user_groups (group_name, group_level, group_status) VALUES ('$name', '$level', '$status')";
        if ($db->query($query)) {
            // Success
            $session->msg('s', 'The group has been created successfully.');
            redirect('manage_groups.php', false);
        } else {
            // Failed
            $session->msg('d', 'Failed to create the group. Please try again.');
            redirect('manage_groups.php', false);
        }
    } else {
        $session->msg("d", "Please correct the following errors: $errors");
        redirect('manage_groups.php', false);
    }
}
?>
<?php include_once ('layout/footer.php'); ?>