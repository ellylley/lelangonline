<div class="main-content container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header">
                    <!-- Breadcrumb jika diperlukan -->
                </nav>
            </div>
        </div>
    </div>

    <div class="row" id="table-bordered">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title" align="center">ACTIVITY LOG</h4>
                    
                    <!-- Form Search -->
                    <!-- <form method="GET" action="" class="form-inline" style="margin-top: 10px; display: flex; flex-wrap: wrap; justify-content: flex-start;">
                        <div class="form-group mb-2" style="flex: 1; min-width: 220px; margin-right: 15px;">
                            <input type="text" name="id_user" class="form-control form-control-sm" placeholder="Search ID User" value="<?= htmlspecialchars($id_user) ?>">
                        </div>
                        <div class="form-group mb-2" style="flex: 1; min-width: 220px; margin-right: 15px;">
                            <input type="text" name="username" class="form-control form-control-sm" placeholder="Search Nama User" value="<?= htmlspecialchars($username) ?>">
                        </div>
                        <div class="form-group mb-2" style="flex: 1; min-width: 220px; margin-right: 15px;">
                            <input type="text" name="activity" class="form-control form-control-sm" placeholder="Search Activity" value="<?= htmlspecialchars($activity) ?>">
                        </div>
                        <div class="form-group mb-2" style="flex: 1; min-width: 220px; margin-right: 15px;">
                            <input type="date" name="timestamp" class="form-control form-control-sm" placeholder="Search Timestamp" value="<?= htmlspecialchars($timestamp) ?>">
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm" style="height: calc(1.5em + 0.75rem + 2px); ">Search</button>
                    </form> -->
                </div>

                <div class="card-content">
                    <!-- table bordered -->
                    <div class="table-responsive">
                        <table class="table table-bordered mb-0">
                            <thead>
                                <tr>
                                    <th>ID User</th>
                                    <th>Nama User</th>
                                    <th>Activity</th>
                                    <th>Timestamp</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($logs) && is_array($logs)) : ?>
                                    <?php foreach ($logs as $log) : ?>
                                        <tr>
                                            <td><?= htmlspecialchars($log->id_user) ?></td>
                                            <td><?= htmlspecialchars($log->username) ?></td>
                                            <td><?= htmlspecialchars($log->activity) ?></td>
                                            <td><?= htmlspecialchars($log->timestamp) ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <tr>
                                        <td colspan="4" class="text-center">No activity logs available.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
