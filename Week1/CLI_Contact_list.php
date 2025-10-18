<?php

// Initialize contact list array)
$contacts = [
    ['name' => 'AniketSingh', 'email' => 'aniket52777@gmail.com', 'phone' => '7208541701'],
    ['name' => 'Ajay', 'email' => 'Ajay@gmail.com', 'phone' => '7738433111']
];

// Function to parse query string from CLI argument
function parseQueryString($queryString)
{
    $params = [];
    parse_str($queryString, $params); // PHP's parse_str to parse key=value pairs
    return $params;
}

// Function to list all contacts
function listContacts($contacts)
{
    if (empty($contacts)) {
        echo "No contacts found.\n";
        return;
    }
    foreach ($contacts as $index => $contact) {
        echo "Contact " . ($index + 1) . ":\n";
        echo "  Name: " . $contact['name'] . "\n";
        echo "  Email: " . $contact['email'] . "\n";
        echo "  Phone: " . $contact['phone'] . "\n";
        echo "\n";
    }
}

// Function to add a contact
function addContact(&$contacts, $name, $email, $phone)
{
    $contacts[] = [
        'name' => $name,
        'email' => $email,
        'phone' => $phone
    ];
    echo "Added contact: $name\n";
}

// Function to delete a contact by name
function deleteContact(&$contacts, $name)
{
    foreach ($contacts as $index => $contact) {
        if (mb_strtolower($contact['name']) === mb_strtolower($name)) {
            array_splice($contacts, $index, 1);
            echo "Deleted contact: $name\n";
            return true;
        }
    }
    echo "Contact not found: $name\n";
    return false;
}

// Function to update a contact by name
function updateContact(&$contacts, $name, $newName, $newEmail, $newPhone)
{
    foreach ($contacts as &$contact) {
        if (mb_strtolower($contact['name']) === mb_strtolower($name)) {
            $contact['name'] = $newName ?? $contact['name'];
            $contact['email'] = $newEmail ?? $contact['email'];
            $contact['phone'] = $newPhone ?? $contact['phone'];
            echo "Updated contact: $name\n";
            return true;
        }
    }
    echo "Contact not found: $name\n";
    return false;
}

// Check for CLI arguments
if ($argc < 2) {
    echo "Usage: php contact_list.php \"action=<action>&name=<name>&email=<email>&phone=<phone>\"\n";
    echo "Actions: list, add, delete, update\n";
    exit(1);
}

// Parse query string from CLI argument (e.g., "action=list" or "action=add&name=aniket")
$queryString = $argv[1] ?? '';
$params = parseQueryString($queryString);

$action = $params['action'] ?? '';
if (!in_array($action, ['list', 'add', 'delete', 'update'])) {
    echo "Invalid action. Use: list, add, delete, update\n";
    exit(1);
}

switch ($action) {
    case 'list':
        listContacts($contacts);
        break;

    case 'add':
        if (!isset($params['name'], $params['email'], $params['phone'])) {
            echo "Missing parameters: name, email, and phone are required\n";
            exit(1);
        }
        addContact($contacts, $params['name'], $params['email'], $params['phone']);
        break;

    case 'delete':
        if (!isset($params['name'])) {
            echo "Missing parameter: name is required\n";
            exit(1);
        }
        deleteContact($contacts, $params['name']);
        break;

    case 'update':
        if (!isset($params['name'])) {
            echo "Missing parameter: name is required\n";
            exit(1);
        }
        updateContact(
            $contacts,
            $params['name'],
            $params['new_name'] ?? NULL,
            $params['new_email'] ?? NULL,
            $params['new_phone'] ?? NULL
        );
        break;
}
echo "\nCurrent Contact List:\n";
listContacts($contacts);
