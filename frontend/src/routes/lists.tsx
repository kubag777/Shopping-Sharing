import React, { useState, useEffect } from 'react';
import axios from 'axios';
import '../css/global.css';
import '../css/lists.css';
import { useNavigate } from 'react-router-dom';

interface List {
  id: string;
  Name: string;
  CreateDate: string;
  OwnerUserID: string;
}


const Lists: React.FC = () => {
  const [userLists, setUserLists] = useState<List[]>([]);
  const storedToken = sessionStorage.getItem('token');
  const navigate = useNavigate();

  useEffect(() => {
    const fetchUserLists = async () => {
      try {
        const response = await axios.get('https://localhost:443/api/my_listss',{
          headers: {
            Authorization: `Bearer ${storedToken}`
          }
        });
        const lists: List[] = response.data['hydra:member'] || []; 
        const formattedLists = lists.map((list: any) => ({
          id: list['@id'].split('/').pop(),
          Name: list.Name,
          CreateDate: list.CreateDate,
          OwnerUserID: list.OwnerUserID,
        }));
        setUserLists(formattedLists);
      } catch (error) {
        console.error('Błąd pobierania list:', error);
      }
    };
    
    
    fetchUserLists();
  }, []);

  const addNewListWnd = () => {
    const newListWnd = document.querySelector('.newListWnd');
    if (newListWnd) {
        newListWnd.classList.toggle('visible');
    }
  };

  const handleAddNewList = async (e: React.FormEvent) => {
    e.preventDefault();
    const formData = new FormData(e.target as HTMLFormElement);
    formData.append('user_id', getUserId().toString()); // Zakładając, że masz funkcję getUserId()

    try {
      const response = await fetch('/api/addNewList', {
        method: 'POST',
        body: formData,
      });

      if (response.ok) {
        window.location.reload();
      } else {
        console.error('Błąd dodawania listy.');
      }
    } catch (error) {
      console.error('Błąd sieci:', error);
    }
  };

  const getUserId = (): number => {
    // Implementacja funkcji getUserId
    return 0; // Zastąp odpowiednią logiką
  };

  return (
    <>
      <div className="mainFrame">
        <div className="headerClass">
          <span>Twoje listy</span>
          <button type="button" onClick={addNewListWnd}><div className="addNew">+</div></button>
        </div>

        <div className="lists">
          {userLists.map((list) => (
            <div className="oneList" key={list.id} onClick={() => navigate(`/list/${list.id}`)}>
              {<div className="listIcon"><img src="/public/list.png" style={{ width: '70%' }} alt="List icon" /></div>}
              <div className="listData">
                <div className="nazwa">{list.Name}</div>
              </div>
            </div>
          ))}
        </div>
      </div>

      <div className="newListWnd">
        <form onSubmit={handleAddNewList} className="addNewList">
          <input type="text" name="listName" placeholder="Nazwa Listy" />
          <input type="text" name="friend" placeholder="ID znajomego" />
          <input type="submit" value="Dodaj" />
        </form>
      </div>
    </>
  );
};

export default Lists;
