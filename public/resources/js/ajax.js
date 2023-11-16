async function ajax(url, method = "get", data = {}) {
  method = method.toLowerCase();

  let options = {
    method: method,
    headers: {
      "Content-Type": "application/json",
      "X-Requested-With": "XMLHttpRequest",
    },
  };

  const csrfMethods = new Set(["post", "put", "delete", "patch"]);

  if (csrfMethods.has(method)) {
    options.body = data;
  } else if (method === "get") {
    url += `?${new URLSearchParams(data).toString()}`;
  }

  return await fetch(url, options);
  // const response = await fetch(url, options);
  // return await response.json();
}

export default ajax;
