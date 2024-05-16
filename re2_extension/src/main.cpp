#define CROW_MAIN
#include <crow.h>
#include <re2/re2.h>

int main() {
    crow::SimpleApp app;

    // Define the hardcoded regex pattern
    const std::string pattern = "A(B|C+)+D";  // Replace with your actual regex pattern

    CROW_ROUTE(app, "/diff_regex_engine").methods(crow::HTTPMethod::POST)([&pattern](const crow::request& req) {
        auto text = req.url_params.get("text");

        if (!text) {
            return crow::response(400, "Text parameter is required.");
        }

        RE2 re(pattern);
        if (!re.ok()) {
            return crow::response(400, "Invalid regex pattern.");
        }

        bool is_match = RE2::FullMatch(text, re);

        if (is_match) {
            return crow::response(200, "Match found");
        } else {
            return crow::response(400, "No match found");
        }
    });

    app.port(8080).multithreaded().run();
    return 0;
}
