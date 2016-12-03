package com.example.mihkel.libraryapp.Various;

public class AppManagerSingleton
{
    public static final String SCHOOL_ID = "schoolId";

    public static Integer selectedSchoolId;
    public static Integer selectedClassId;
    public static Integer selectedBookListId;
    public static Integer selectedBookId;
//    public static Integer selectedId;

    private static AppManagerSingleton _instance;
//    private static HashMap<Integer, HashMap<Integer, String>> data = new HashMap<Integer, HashMap<Integer, String>>();

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
//
//    public Boolean hasData() {
//        return data == null;
//    }
//
//    public Boolean hasDataAtKey(Integer key) {
//        return (data.containsKey(key) && data.get(key) != null);
//    }
//
//    public HashMap<Integer, String> getDataAtKey(Integer key) {
//        return data.get(key);
//    }
//
//    public void setDataAtKey(Integer key, HashMap<Integer, String> incomingData) {
//        data.put(key, incomingData);
//    }


}