extern crate regex;

use regex::Regex;
use std::io::{self, Write};

fn main() {
    let re = Regex::new("A(B|C+)+D").unwrap();

    print!("Please enter some text: ");
    io::stdout().flush().unwrap();  // Flush stdout to display the prompt before read_line

    let mut input = String::new();
    io::stdin().read_line(&mut input).unwrap();

    match re.is_match(&input.trim()) {
        true => println!("Match found"),
        false => println!("No match found"),
    }
}