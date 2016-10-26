package com.example.mihkel.libraryapp;

public class AppManagerSingleton
{
    private static AppManagerSingleton _instance;

    private AppManagerSingleton()
    {

    }

    public synchronized static AppManagerSingleton getInstance()
    {
        if (_instance == null)
        {
            _instance = new AppManagerSingleton();
        }
        return _instance;
    }
}