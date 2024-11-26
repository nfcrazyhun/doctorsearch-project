<?php
include_once './search.php'; // Include the logic file
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orvos Kereső</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

<div class="mx-auto max-w-screen-lg p-5">
    <h1 class="mb-5 text-center text-3xl font-bold">Orvos Kereső</h1>

    <form method="GET" action="" class="mb-5">
        <div class="flex flex-col justify-center sm:flex-row">
            <input type="text" name="search" placeholder="Orvos neve" value="<?php echo htmlspecialchars($searchTerm); ?>"
                   class="mb-2 w-full rounded-l border border-gray-300 px-4 py-2 sm:mb-0 sm:w-1/3" />
            <input type="submit" value="Keresés"
                   class="cursor-pointer rounded-r bg-blue-500 px-4 py-2 text-white hover:bg-blue-600" />
        </div>
    </form>

    <h2 class="mb-3 text-2xl font-semibold">Orvosok Listája</h2>
    <div class="overflow-x-auto">
        <table class="min-w-full border border-gray-300 bg-white">
            <thead>
            <tr class="bg-gray-200">
                <th class="border px-4 py-2">ID</th>
                <th class="border px-4 py-2">Név</th>
                <th class="border px-4 py-2">Szakterület</th>
                <th class="border px-4 py-2">Klinika</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($filteredDoctors as $doctor) {
                echo "<tr class='hover:bg-gray-100'>
                        <td class='border px-4 py-2'>{$doctor['id']}</td>
                        <td class='border px-4 py-2'>{$doctor['name']}</td>
                        <td class='border px-4 py-2'>{$doctor['specialty']}</td>
                        <td class='border px-4 py-2'>{$doctor['clinics']}</td>
                    </tr>";
            }
            ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>