# AgroTech: Android Application

The AgroTech Android application provides a WebView to load and display a web page. It also includes a bottom navigation view for easy navigation within the app.

## Repository Structure

The repository contains the following files:

- `MainActivity.java`: Represents the main activity of the application. It includes the code for initializing the WebView, loading a web page, and handling navigation through the bottom navigation view.
- `HumActivity.java`: Represents the activity for displaying humidity information. It contains a WebView and handles navigation through the bottom navigation view.
- `TempActivity.java`: Represents the activity for displaying temperature information. It contains a WebView and handles navigation through the bottom navigation view.

## Installation

1. Clone the repository: `git clone https://github.com/Arahat002/AgroTech.git`
2. Open the project in Android Studio.
3. Build and run the application on an Android device or emulator.

## Usage

- Upon launching the application, the WebView will load a web page specified by the `TEST_PAGE_URL` constant.
- The bottom navigation view allows navigation between different sections of the application.
  - Home: Displays the WebView with the loaded web page.
  - Temperature: Navigates to the TemperatureActivity.
  - Humidity: Navigates to the HumidityActivity.
- Additional features, such as handling page loading events, title updates, and external page requests, are also implemented.

## Contributing

Contributions to this project are welcome! If you find any issues or have suggestions for improvements, please open an issue or submit a pull request.

## License

This project is licensed under the Apache License 2.0. See the [LICENSE](LICENSE) file for more details.
