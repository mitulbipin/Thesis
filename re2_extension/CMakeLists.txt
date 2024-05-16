cmake_minimum_required(VERSION 3.10)
project(MyWebServer)

set(CMAKE_CXX_STANDARD 17)

# Add vcpkg toolchain
set(CMAKE_TOOLCHAIN_FILE "${CMAKE_SOURCE_DIR}/vcpkg/scripts/buildsystems/vcpkg.cmake")

# Include directories for Crow and RE2
include_directories(${CMAKE_SOURCE_DIR}/vcpkg/installed/x64-linux/include)

# Link directories for RE2
link_directories(${CMAKE_SOURCE_DIR}/vcpkg/installed/x64-linux/lib)

add_executable(MyWebServer src/main.cpp)

# Link Crow and RE2 libraries
find_package(Crow CONFIG REQUIRED)
target_link_libraries(MyWebServer PRIVATE Crow::Crow re2)
