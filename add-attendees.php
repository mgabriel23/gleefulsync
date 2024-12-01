<!-- menu-size will be the dimension of your menu. If you set it to smaller than your content it will scroll-->
<div class="menu-size" style="height:365px;">
    <div class="d-flex mx-3 mt-3 mb-3 py-1">
        <div class="align-self-center">
            <h1 class="mb-0">Add Attendees</h1>
        </div>
        <div class="align-self-center ms-auto">
            <a href="#" class="ps-4 shadow-0 me-n2" data-bs-dismiss="offcanvas">
                <i class="bi bi-x color-red-dark font-26 line-height-xl"></i>
            </a>
        </div>
    </div>
    <div class="content mt-0">
        <?php
            include 'connection.php';

            $query = "SELECT a.group_no, c.name, c.id FROM groups_tbl a INNER JOIN group_members_tbl b ON a.id = b.group_id INNER JOIN members_tbl c ON b.member_id = c.id";
            $stmt = $pdo->prepare($query);
            $stmt->execute();
            $members = $stmt->fetchAll();
        ?>
            <div class="table-responsive">
                <table class="table color-theme mb-2">
                <tbody>
                    <?php if ($members): ?>
                        <?php foreach ($members as $member): ?>
                            <tr class="border-fade-blue">
                                <td class="cb-center">
                                    <input type="checkbox" value="<?php echo htmlspecialchars($member['id']); ?>" />
                                    <span><?php echo htmlspecialchars($member['group_no']); ?></span>
                                    <span><?php echo htmlspecialchars($member['name']); ?></span>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="2" class="text-center">No attendees found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
                </table>
            </div>
        
        <div style="text-align: right;">
            <button type="submit" class="btn btn-xxs gradient-blue shadow-bg shadow-bg-xs">
                Submit Attendance
            </button>
        </div>
    </div>
</div>