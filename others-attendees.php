<!-- menu-size will be the dimension of your menu. If you set it to smaller than your content it will scroll-->
<div class="menu-size" style="height:365px;">
    <div class="d-flex mx-3 mt-3 py-1">
        <div class="align-self-center">
            <h1 class="mb-0">Others</h1>
        </div>
        <div class="align-self-center ms-auto">
            <div data-bs-toggle="offcanvas" data-bs-target="#add-attendees" class="m-auto">
                <span class="btn btn-xxs gradient-blue shadow-bg shadow-bg-xs">Add Attendee</span>
            </div>
        </div>
    </div>
    <div class="divider divider-margins mt-3" style="margin-bottom: 1rem;"></div>
    <div class="content mt-0">
        <?php
            include 'connection.php';

            $query = "SELECT f.group_id AS group_no, c.name AS attendee_name FROM attendance_tbl a INNER JOIN locales_tbl b ON a.locale_id = b.id INNER JOIN members_tbl c ON a.member_id = c.id INNER JOIN batches_tbl d ON a.batch_id = d.id INNER JOIN platforms_tbl e ON a.platform_id = e.id INNER JOIN group_members_tbl f ON a.member_id = f.member_id WHERE e.short_name = 'Others' AND CURRENT_TIME() BETWEEN d.start_time AND d.end_time AND d.day = (WEEKDAY(CURRENT_DATE())) AND DATE(a.date_created) = CURRENT_DATE() ORDER BY f.group_id ASC";
            $stmt = $pdo->prepare($query);
            $stmt->execute();
            $attendees = $stmt->fetchAll();
        ?>
            <div class="table-responsive">
                <table class="table color-theme mb-2">
                <thead>
                    <tr>
                    <th class="border-fade-blue" scope="col" style="width: 30%;">Group #</th>
                    <th class="border-fade-blue" scope="col">Name</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($attendees): ?>
                        <?php foreach ($attendees as $attendee): ?>
                            <tr class="border-fade-blue">
                                <td><?php echo htmlspecialchars($attendee['group_no']); ?></td>
                                <td><?php echo htmlspecialchars($attendee['attendee_name']); ?></td>
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
    </div>
</div>