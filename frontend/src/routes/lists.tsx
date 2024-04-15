import React, { useState, useEffect } from 'react';
import '../css/global.css';
import '../css/lists.css';

const Lists: React.FC = () => {
  const [userLists, setUserLists] = useState<any[]>([]);
  const [showNewListWindow, setShowNewListWindow] = useState<boolean>(false);

  useEffect(() => {
    const fetchUserLists = async () => {
      try {
        const response = await fetch('/api/getUserLists');
        if (response.ok) {
          const data = await response.json();
          setUserLists(data);
        } else {
          console.error('Błąd pobierania list.');
        }
      } catch (error) {
        console.error('Błąd sieci:', error);
      }
    };

    fetchUserLists();
  }, []);

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
        setShowNewListWindow(false);
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
          <button type="button" onClick={() => setShowNewListWindow(true)}><div className="addNew">+</div></button>
        </div>

        <div className="lists">
          {userLists.map((list) => (
            <div className="oneList" key={list.id} onClick={() => window.location.href = `listView/?id=${list.id}`}>
              <div className="listIcon"><img src="/public/img/list.png" style={{ width: '80%' }} alt="List icon" /></div>
              <div className="listData">
                <div className="nazwa">{list.name}</div>
              </div>
            </div>
          ))}
        </div>
      </div>

      {showNewListWindow && (
        <div className="newListWnd">
          <form onSubmit={handleAddNewList} className="addNewList">
            <input type="text" name="listName" placeholder="Nazwa Listy" />
            <input type="text" name="friend" placeholder="ID znajomego" />
            <input type="submit" value="Dodaj" />
          </form>
        </div>
      )}
    </>
  );
};

export default Lists;
