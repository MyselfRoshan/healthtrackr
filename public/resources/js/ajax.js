const ajax = (url, method = "get", data = {}) => {
  method = method.toLowerCase;

  let options = {
    method,
    header: {
      "Content-Type": "application/json",
      "X-Requested-With": "XMLHttpRequest",
    },
  };

  const csrfMethods = new Set(["post", "put", "delete", "patch"]);

  if (csrfMethods.has(method)) {
    options.body = JSON.stringify({ ...data, ...getCsrfFields() });
/**
 * 
 *    } else if (method === "get") {
    url += "?" + new URLSearchParams(data).toString();
  } */

  return fetch(url, options).then((response) => response.json());
};
