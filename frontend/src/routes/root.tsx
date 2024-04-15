import { Outlet } from "react-router-dom";

export default function Root() {
    return (
      <>
        <div id="sidebar">  
          <nav>
            <ul>
              <li>
                <a href={`/login`}>Login</a>
              </li>
              <li>
                <a href={`/register`}>Register</a>
              </li>
              <li>
                <a href={`/myLists`}>Listy</a>
              </li>
              <li>
                <a href={`/list`}>Konkretna Lista</a>
              </li>
              <li>
                <a href={`/profile`}>Profil</a>
              </li>
            </ul>
          </nav>
        </div>
        <div id="detail">
          <Outlet />
        </div>
      </>
    );
  }