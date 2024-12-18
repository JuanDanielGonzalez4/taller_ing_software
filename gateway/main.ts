const SERVICE_MAP: Record<string, string> = {
  "/api/orders": "http://localhost:9001",
  "/api/products": "http://localhost:9002",
  "/api/reports": "http://localhost:9003",
};

Deno.serve(async (req) => {
  const method = req.method;
  const url = new URL(req.url);
  const path = url.pathname;

  const apiKey = Deno.env.get("API_KEY");

  if (!apiKey) {
    throw Error("Couldn't load api key!")
  }

  let targetServiceUrl: string | null = null;

  for (const [routePrefix, serviceUrl] of Object.entries(SERVICE_MAP)) {
    if (path.startsWith(routePrefix)) {
      targetServiceUrl = serviceUrl;
      break;
    }
  }

  if (!targetServiceUrl) {
    console.log("No matching microservice found for path:", path);
    return new Response("Not Found", { status: 404 });
  }

  const targetUrl = `${targetServiceUrl}${path}${url.search}`;

  const forwardHeaders = new Headers({"bearer": apiKey});

  const forwardRequest = new Request(targetUrl, {
    method: method,
    headers: forwardHeaders,
    body: req.body ? req.body : null,
    redirect: "follow",
  });

  console.log("\nREQUEST:")
  console.log(forwardRequest)

  // Forward the request to the appropriate microservice
  let response: Response;
  try {
    response = await fetch(forwardRequest);
  } catch (error) {
    console.error("Error forwarding request:", error);
    return new Response("Bad Gateway", { status: 502 });
  }

  return response;
});
