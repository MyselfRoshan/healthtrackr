async function ajax(url, method = "get", data = {}) {
  // method = method.toLowerCase();
  method = method.toUpperCase();

  let options = {
    method: method,
    headers: {
      "Content-Type": "application/json",
      "X-Requested-With": "XMLHttpRequest",
    },
  };

  // const csrfMethods = new Set(["post", "put", "delete", "patch"]);
  const csrfMethods = new Set(["POST", "PUT", "DELETE", "PATCH"]);

  if (csrfMethods.has(method)) {
    options.body = data;
    // } else if (method === "get") {
  } else if (method === "GET") {
    url += `?${new URLSearchParams(data).toString()}`;
  }

  return await fetch(url, options);
  // const response = await fetch(url, options);
  // return await response.json();
}

export default ajax;
