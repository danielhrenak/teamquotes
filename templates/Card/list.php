<!-- File: templates/Card/list.php -->
                            <!DOCTYPE html>
                            <html lang="en">
                            <head>
                                <meta charset="UTF-8">
                                <title>Employee Cards List</title>
                                <style>
                                    body {
                                        font-family: Arial, sans-serif;
                                        margin: 20px;
                                        background-color: #f9f9f9;
                                    }
                                    h1 {
                                        text-align: center;
                                        color: #333;
                                    }
                                    table {
                                        width: 100%;
                                        border-collapse: collapse;
                                        margin: 20px 0;
                                        background: #fff;
                                        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
                                    }
                                    th, td {
                                        padding: 10px;
                                        text-align: left;
                                        border: 1px solid #ddd;
                                    }
                                    th {
                                        background-color: #f4f4f4;
                                        color: #555;
                                    }
                                    tr:nth-child(even) {
                                        background-color: #f9f9f9;
                                    }
                                    a {
                                        color: #007bff;
                                        text-decoration: none;
                                    }
                                    a:hover {
                                        text-decoration: underline;
                                    }
                                </style>
                            </head>
                            <body>
                                <h1>Employee Cards List</h1>
                                <table>
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Full Name</th>
                                            <th>Slug</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($employeeCards as $card): ?>
                                            <tr>
                                                <td><?= h($card->id) ?></td>
                                                <td><?= h($card->full_name) ?></td>
                                                <td><?= h($card->slug) ?></td>
                                                <td><?= empty($card->full_name) ? 'Not Filled' : 'Filled' ?></td>
                                                <td>
                                                    <a href="<?= $this->Url->build(['action' => 'index', $card->slug]) ?>">View</a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </body>
                            </html>
