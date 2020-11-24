export function submitLogin(email, password) {
  return new Promise(function(resolve, reject) {
    const req = new XMLHttpRequest();
    req.open("POST", "/api/v1/token");
    req.addEventListener("load", resolve);
    req.addEventListener("error", reject);
    req.responseType  = "json";
    req.setRequestHeader("Content-Type", "application/json");
    req.send(JSON.stringify({email, password}));
  });
}
