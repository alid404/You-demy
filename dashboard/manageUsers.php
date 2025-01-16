<?php
require_once '../class/Admin.php';

session_start();

if (!isset($_SESSION["id"]) || $_SESSION["role"] !== "admin") {
    header("Location: ../login/index.php");
    exit();
}

$users = new Admin();
$user = $users->getAllUsers();

?>

<?php
include_once './layout/header.php';
?>

<div class="dash-content">
    <div class="overview">
        <div class="title">
            <i class="uil uil-tachometer-fast-alt"></i>
            <span class="text">Manage Users</span>
        </div>
    </div>

    <div class="activity">
        <div class="activity-data">
            <table class="min-w-full border border-gray-200 shadow-sm rounded-lg overflow-hidden">
                <thead class="bg-gray-50">
                    <tr class="text-left text-gray-600 uppercase text-sm tracking-wider">
                        <th class="px-4 py-3 border-b">ID</th>
                        <th class="px-4 py-3 border-b">Name</th>
                        <th class="px-4 py-3 border-b">Role</th>
                        <th class="px-4 py-3 border-b">Status</th>
                        <th class="px-4 py-3 border-b">
                            <center>Action</center>
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php
                    $i = 0;
                    while ($i < count($user)): ?>
                        <tr class="hover:bg-gray-100">
                            <td class="px-4 py-3"><?php echo htmlspecialchars($user[$i]["id"]) ?></td>
                            <td class="px-4 py-3"><?php echo htmlspecialchars($user[$i]["name"]) ?></td>
                            <td class="px-4 py-3"><?php echo htmlspecialchars($user[$i]["role"]) ?></td>
                            <td class="px-4 py-3">
                                <?php if ($user[$i]["status"] == 'active'): ?>
                                    <span class="px-2 py-1 text-xs font-medium text-green-700 bg-green-100 rounded-full">Active</span>
                                <?php elseif ($user[$i]["status"] == 'suspended'): ?>
                                    <span class="px-2 py-1 text-xs font-medium text-red-700 bg-red-100 rounded-full">Suspended</span>
                                <?php elseif ($user[$i]["status"] == 'pending'): ?>
                                    <span class="px-2 py-1 text-xs font-medium text-yellow-700 bg-yellow-100 rounded-full">Deactivated</span>
                                <?php endif; ?>
                            </td>
                            <td class="px-4 py-3">
                                <center>
                                    <div class="relative">
                                        <button><a href="./userActivate.php?id=<?php echo htmlspecialchars($user[$i]["id"]) ?>" class="block px-4 py-2 text-gray-700 rounded-full hover:bg-green-100">Activate</a></button>
                                        <button><a href="./userDeactivate.php?id=<?php echo htmlspecialchars($user[$i]["id"]) ?>" class="block px-4 py-2 text-gray-700 rounded-full hover:bg-yellow-100">Deactivate</a></button>
                                        <button><a href="./userSuspend.php?id=<?php echo htmlspecialchars($user[$i]["id"]) ?>" class="block px-4 py-2 text-gray-700 rounded-full hover:bg-red-100">Suspend</a></button>
                                    </div>
                                </center>
                            </td>
                        </tr>
                    <?php
                        $i++;
                    endwhile;
                    ?>
                </tbody>
            </table>

        </div>
    </div>
</div>

<?php
include_once './layout/footer.php';
?>