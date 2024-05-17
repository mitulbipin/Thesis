extern crate hyper;
extern crate regex;
extern crate serde;
extern crate serde_json;
extern crate serde_derive;

use hyper::{Body, Request, Response, Server};
use hyper::service::{make_service_fn, service_fn};
use hyper::Method;
use regex::Regex;
use serde_derive::Deserialize;
use std::convert::Infallible;
use tokio::runtime::Runtime;

#[derive(Deserialize)]
struct PostRequest {
    text: String,
}

async fn handle_request(req: Request<Body>) -> Result<Response<Body>, Infallible> {
    match (req.method(), req.uri().path()) {
        (&Method::POST, "/match") => {
            let whole_body = hyper::body::to_bytes(req.into_body()).await.unwrap();
            let post_req: PostRequest = serde_json::from_slice(&whole_body).unwrap();
            let re = Regex::new("A(B|C+)+D").unwrap();
            let response = match re.is_match(&post_req.text) {
                true => "Match found",
                false => "No match found",
            };
            Ok(Response::new(Body::from(response)))
        },
        _ => {
            Ok(Response::new(Body::from("Route not found")))
        },
    }
}

fn main() {
    let rt = Runtime::new().unwrap();
    rt.block_on(async {
        let make_svc = make_service_fn(|_conn| {
            async { Ok::<_, Infallible>(service_fn(handle_request)) }
        });

        let addr = ([0 ,0 ,0 , 0], 3000).into();
        let server = Server::bind(&addr).serve(make_svc);

        if let Err(e) = server.await {
            eprintln!("server error: {}", e);
        }
    });
}