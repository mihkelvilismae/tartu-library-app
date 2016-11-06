//package com.example.mihkel.libraryapp;
//
//import com.google.gson.Gson;
//import com.google.gson.reflect.TypeToken;
//
//import java.util.HashMap;
//
//public class _DatabaseManagerSingleton
//{
//    public static final Integer SCHOOLS_DATA_KEY = 1;
//    public static final Integer CLASSES_DATA_KEY = 2;
//    public static final Integer READING_LIST_DATA_KEY = 3;
//
//    private static _DatabaseManagerSingleton _instance;
////    private static HashMap<Integer, HashMap<Integer, String>> data = new HashMap<Integer, HashMap<Integer, String>>();
//
//    private static HashMap<Integer, String> schoolsData = new HashMap<>();
//    private static HashMap<Integer, HashMap<Integer, String>> classesBySchoolData = new HashMap<Integer, HashMap<Integer, String>>();
//    private static HashMap<Integer, HashMap<Integer, String>> booksByClassesData = new HashMap<Integer, HashMap<Integer, String>>();
//
//    private _DatabaseManagerSingleton()
//    {
//
//    }
//
//    public synchronized static _DatabaseManagerSingleton getInstance()
//    {
//        if (_instance == null)
//        {
//            _instance = new _DatabaseManagerSingleton();
//        }
//        return _instance;
//    }
////
////    public Boolean hasData() {
////        return data == null;
////    }
//    public void setSchoolsList(HashMap<Integer, String> map) {
//        setDataAtKey(SCHOOLS_DATA_KEY, map);
//    }
//
//    public HashMap<Integer, String> getSchoolsList() {
//        return getDataAtKey(SCHOOLS_DATA_KEY);
//    }
//
//    public boolean hasSchoolsList() {
//        return hasDataAtKey(SCHOOLS_DATA_KEY);
//    }
//
//    public void setClassesInSchool(HashMap<Integer, String> map) {
//
//    }
//
//    public HashMap<Integer, String> getClassesInSchool() {
//
//    }
//
//    public HashMap<Integer, String> getBooksListInClass() {
//
//    }
//
//    public void setBooksListInClass(HashMap<Integer, String> map) {
//
//    }
//    //------------------------------------------------------------------------------------------------------------------------------------
//    //------------------------------------------------------------------------------------------------------------------------------------
//
//    public Boolean hasDataAtKey(Integer key) {
//        return (data.containsKey(key) && data.get(key) != null);
//    }
//
//    public Boolean hasDataAtKey(Integer key, int id) {
//        return (hasDataAtKey(key) && data.get(key).containsKey(id) && data.get(key).get(id) != null);
//    }
//
//    public HashMap<Integer, String> getDataAtKey(Integer key) {
//        return data.get(key);
//    }
//
//    public String getDataAtKeyAndId(Integer key, int id) {
//        return data.get(key).get(id);
//    }
//
//    public void setDataAtKey(Integer key, HashMap<Integer, String> incomingData) {
//        data.put(key, incomingData);
//    }
//
//     public void setSchoolListResult(String jsonString) {
////        Object x = new Gson().fromJson(line, new TypeToken<HashMap<Integer, String>>(){}.getType());
//        HashMap<Integer, String> map = new Gson().fromJson(jsonString, new TypeToken<HashMap<Integer, String>>() {
//        }.getType());
////        setDataAtKey(DatabaseManagerSingleton.SCHOOLS_DATA_KEY, map);
//        //AppManagerSingleton.getInstance().setDataAtKey(AppManagerSingleton.SCHOOLS_DATA_KEY);
//    }
//
//    public void setClassesInSchoolJson(int schoolId, String jsonString) {
////        Object x = new Gson().fromJson(line, new TypeToken<HashMap<Integer, String>>(){}.getType());
//        HashMap<Integer, String> map = new Gson().fromJson(jsonString, new TypeToken<HashMap<Integer, String>>() {
//        }.getType());
//        setDataAtKey(_DatabaseManagerSingleton.SCHOOLS_DATA_KEY, map);
//        //AppManagerSingleton.getInstance().setDataAtKey(AppManagerSingleton.SCHOOLS_DATA_KEY);
//    }
//
//    public void setClassReadingListResult(int classId, String jsonString) {
////        Object x = new Gson().fromJson(line, new TypeToken<HashMap<Integer, String>>(){}.getType());
//        HashMap<Integer, String> map = new Gson().fromJson(jsonString, new TypeToken<HashMap<Integer, String>>() {
//        }.getType());
//        setDataAtKey(_DatabaseManagerSingleton.SCHOOLS_DATA_KEY, map);
//        //AppManagerSingleton.getInstance().setDataAtKey(AppManagerSingleton.SCHOOLS_DATA_KEY);
//    }
//
//
//}