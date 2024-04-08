<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-800">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Management</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flowbite/dist/flowbite.min.css" />
</head>
<body class="h-full text-white">

<div class="flex flex-col items-center w-full p-4">
    <div class="mb-4">
        <h1 class="text-2xl font-bold">Your Passwords</h1>
    </div>
    <div class="flex flex-wrap justify-between w-full max-w-4xl mb-4 gap-4">
        <div class="flex-1 min-w-0">
            <input type="text" placeholder="Search..." class="w-full px-4 py-2 rounded-lg focus:ring-blue-500 focus:border-blue-500" />
        </div>
        <button class="px-4 py-2 text-white bg-blue-500 rounded-lg hover:bg-blue-600">
            Search
        </button>
        <button class="px-4 py-2 text-white bg-green-500 rounded-lg hover:bg-green-600">
            Home
        </button>
        <button class="px-4 py-2 text-white bg-purple-500 rounded-lg hover:bg-purple-600">
            Add Password
        </button>
    </div>
    <div class="w-full overflow-x-auto max-w-4xl">
        <table class="w-full text-sm text-left text-gray-400">
            <thead class="text-xs uppercase bg-gray-700 text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">URL</th>
                    <th scope="col" class="px-6 py-3">Mail</th>
                    <th scope="col" class="px-6 py-3">Password</th>
                    <th scope="col" class="px-6 py-3">Data</th>
                    <th scope="col" class="px-6 py-3">Edit</th>
                    <th scope="col" class="px-6 py-3">Delete</th>
                </tr>
            </thead>
            <tbody>
                <tr class="border-b dark:border-gray-700 hover:bg-gray-700">
                    <td class="px-6 py-4"><a href="#" class="text-blue-500 hover:underline">Example.com</a></td>
                    <td class="px-6 py-4">user@example.com</td>
                    <td class="px-6 py-4">
                        <div class="flex items-center">
                            <span class="password-text">••••••••</span>
                            <input type="checkbox" id="toggle-password" class="ml-2 w-5 h-5" />
                        </div>
                    </td>
                    <td class="px-6 py-4">01/01/2024</td>
                    <td class="px-6 py-4">
                        <button class="p-2 text-white bg-blue-600 rounded-lg hover:bg-blue-700">
                            Edit
                        </button>
                    </td>
                    <td class="px-6 py-4">
                        <button class="p-2 text-white bg-red-600 rounded-lg hover:bg-red-700">
                            Delete
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/flowbite/dist/flowbite.min.js"></script>
<script>
    document.getElementById('toggle-password').addEventListener('change', function() {
        const passwordText = document.querySelector('.password-text');
        this.checked ? passwordText.textContent = 'password123' : passwordText.textContent = '••••••••';
    });
</script>
</body>
</html>