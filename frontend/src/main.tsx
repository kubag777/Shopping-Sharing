import * as React from "react";
import * as ReactDOM from "react-dom/client";
import {
  createBrowserRouter,
  RouterProvider,
} from "react-router-dom";
import "./index.css";
import Root from "./routes/root";
import ErrorPage from "./error-page";
import LoginPage from "./routes/login";
import RegisterPage from "./routes/register";
import Lists from "./routes/lists";
import ListView from "./routes/listView";
import ProfilePage from "./routes/profile";



const router = createBrowserRouter([
  {
    path: "/",
    element: <Root />,
    errorElement: <ErrorPage />,
    children: [
      {
        path: "login",
        element: <LoginPage />,
      },
      {
        path: "register",
        element: <RegisterPage />,
      },
      {
        path: "myLists",
        element: <Lists />,
      },
      {
        path: "list/:id",
        element: <ListView />,
      },
      {
        path: "profile",
        element: <ProfilePage />,
      },
    ],
  },
]);

const App = () => {
  return (
    <React.StrictMode>
      <RouterProvider router={router} />
    </React.StrictMode>
  );
};

ReactDOM.createRoot(document.getElementById("root")!).render(<App />);
