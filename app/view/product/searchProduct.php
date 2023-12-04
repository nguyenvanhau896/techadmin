<?php
    $server_name = "localhost";
    $user_name = "root";
    $password = "";
    $database = "techshop";

    $conn = mysqli_connect($server_name, $user_name, $password, $database);
    if (!$conn) {
        echo "Connection failed!";
    }
    $page = isset($_POST['page']) ? $_POST['page'] : 1;
    $recordsPerPage = isset($_POST['recordsPerPage']) ? $_POST['recordsPerPage'] : 10;
    $offset = ($page - 1) * $recordsPerPage;

    if (isset($_POST['search'])) {
        $search = $_POST["search"];
        $query = "SELECT * FROM `product` WHERE `name` LIKE '%$search%' LIMIT $offset, $recordsPerPage";

        $result = $conn->query($query);

        if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <tr class="product-cell border-b hover:bg-[#93e7be]">
                <td class="px-6 py-4 w-[5%]">
                    <?=$row["id"];?>
                </td>
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap w-[35%]">
                    <?=$row["name"];?>
                </th>
                <td class="px-6 py-4 flex justify-start w-1/10">
                    <img src="<?=$row["image"];?>" alt="image" class="w-10 h-10">
                </td>
                <td class="px-6 py-4 text-center w-1/10">
                    <?=$row["category"];?>
                </td>
                <td class="px-6 py-4 text-right w-1/5">
                    <?=number_format($row["price"], 0, '', '.') . ' ₫';?>
                </td>
                <td class="text-center px-6 py-4 w-1/5">
                    <a href="/techadmin/admin/product/editProduct" class="text-center font-medium text-blue-600 hover:underline mr-4">Edit</a>
                    <button class="delete text-center font-medium text-red-600 hover:underline" value="<?=$row["id"]?>">Delete</button>
                </td>
            </tr>
            <?php
        }
    }
}

mysqli_close($conn);
?>
