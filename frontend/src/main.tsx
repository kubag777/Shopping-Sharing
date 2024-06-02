import * as React from "react";
import * as ReactDOM from "react-dom/client";
import {
  createBrowserRouter,
  RouterProvider,
  Navigate,
} from "react-router-dom";
import "./index.css";
import Root from "./routes/root";
import ErrorPage from "./error-page";
import LoginPage from "./routes/login";
import RegisterPage from "./routes/register";
import Lists from "./routes/lists";
import ListView from "./routes/listView";
import ProfilePage from "./routes/profile";

const App = () => {
  const [isLoggedIn, setIsLoggedIn] = React.useState<boolean>(false);
  console.log('isLoggedIn:', isLoggedIn);

  const router = createBrowserRouter([
    {
      path: "/",
      element: <Root isLoggedIn={isLoggedIn} />,
      errorElement: <ErrorPage />,
      children: [
        {
          path: "login",
          element: <LoginPage setIsLoggedIn={setIsLoggedIn} />,
        },
        {
          path: "register",
          element: <RegisterPage />,
        },
        {
          path: "myLists",
          element: isLoggedIn ? <Lists /> : <Navigate to="/login" />,
        },
        {
          path: "list/:id",
          element: isLoggedIn ? <ListView /> : <Navigate to="/login" />,
        },
        {
          path: "profile",
          element: isLoggedIn ? <ProfilePage /> : <Navigate to="/login" />,
        },
      ],
    },
  ]);

  return (
    <React.StrictMode>
      <RouterProvider router={router} />
    </React.StrictMode>
  );
};

ReactDOM.createRoot(document.getElementById("root")!).render(<App />);
