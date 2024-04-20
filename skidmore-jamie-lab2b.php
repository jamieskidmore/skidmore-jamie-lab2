<?php
// Command-line file manager in PHP

// Check if the "-d" or "--directory" option is set
if (isset($options["d"]) || isset($options["directory"])) {
    $directory = isset($options["d"]) ? $options["d"] : $options["directory"];

    // Verify if the specified directory exists
    if (is_dir($directory)) {
        while (true) {
            echo PHP_EOL . "Options:" . PHP_EOL;
            echo "1: List files" . PHP_EOL;
            echo "2: View file" . PHP_EOL;
            echo "3: Create file" . PHP_EOL;
            echo "4: Rename file" . PHP_EOL;
            echo "5: Quit" . PHP_EOL;

            $choice = readline("Enter your choice: ");

            switch ($choice) {
                case 1:
                    $files = scandir($directory);
                    print_r($files);
                    break;

                case 2:
                    $filename = readline("Enter the filename to view: ");
                    if (file_exists("$directory/$filename")) {
                        $content = file_get_contents("$directory/$filename");
                        echo $content;
                    } else {
                        echo "$filename does not exist in the directory.";
                    }
                    break;

                case 3:
                    $filename = readline("Enter a name for the new file: ");
                    if (!file_exists("$directory/$filename")) {
                        file_put_contents("$directory/$filename", "");
                        echo "$filename created successfully.";
                    } else {
                        echo "$filename already exists in the directory.";
                    }
                    break;

                case 4:
                    $oldFilename = readline("Enter the current filename to rename: ");
                    if (file_exists("$directory/$oldFilename")) {
                        $newFilename = readline("Enter the new filename: ");
                        rename("$directory/$oldFilename", "$directory/$newFilename");
                        echo "$oldFilename has been renamed to $newFilename";
                    } else {
                        echo "$oldFilename does not exist in the directory.";
                    }
                    break;

                case 5:
                    exit; // Quit the program

                default:
                    echo 'Invalid option. Please try again.';
                    break;
            }
        }
    } else {
        echo "The specified directory does not exist.";
    }
} else {
    echo "Directory not specified.";
}
?>
