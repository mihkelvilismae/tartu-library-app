package com.example.mihkel.libraryapp.Various;

import com.example.mihkel.libraryapp.Item.Book;
import com.example.mihkel.libraryapp.Item.Clazz;
import com.example.mihkel.libraryapp.Item.School;
import com.google.gson.Gson;
import com.google.gson.reflect.TypeToken;

import java.util.HashMap;
import java.util.Map;

public class DatabaseManagerSingleton {
    public static final Integer SCHOOLS_DATA_KEY = 1;
    public static final Integer CLASSES_DATA_KEY = 2;
    public static final Integer READING_LIST_DATA_KEY = 3;

    private static DatabaseManagerSingleton _instance;
//    private static HashMap<Integer, HashMap<Integer, String>> data = new HashMap<Integer, HashMap<Integer, String>>();

    private static HashMap<Integer, School> schoolsData = new HashMap<>();
    private static HashMap<Integer, HashMap<Integer, Clazz>> classesBySchoolData = new HashMap<>();
    private static HashMap<Integer, HashMap<Integer, Book>> booksByClassesData = new HashMap<>();

    private DatabaseManagerSingleton() {

    }

    public synchronized static DatabaseManagerSingleton getInstance() {
        if (_instance == null) {
            _instance = new DatabaseManagerSingleton();
        }
        return _instance;
    }

    public void setSchoolsList(HashMap<Integer, School> map) {
        schoolsData = map;
    }

    public HashMap<Integer, School> getSchoolsList() {
        return schoolsData;
    }

    public boolean hasSchoolsList() {
        return schoolsData != null;
    }

    public boolean hasClassesInSchool(int schoolId) {
        return classesBySchoolData.get(schoolId) != null;
    }

    public void setClassesInSchool(int schoolId, HashMap<Integer, Clazz> map) {
        classesBySchoolData.put(schoolId, map);
    }

    public HashMap<Integer, Clazz> getClassesInSchool(int schoolId) {
        return classesBySchoolData.get(schoolId);
    }

    public boolean hasBooksListInClass(int classId) {
        return booksByClassesData.get(classId) != null;
    }

    public HashMap<Integer, Book> getBooksListInClass(int classId) {
        return booksByClassesData.get(classId);
    }

    public void setBooksListInClass(int classId, HashMap<Integer, Book> map) {
        booksByClassesData.put(classId, map);
    }

    public void setSchoolListResult(String jsonString) {
        setSchoolsList(parseJsonToSchoolMap(jsonString));
    }

    public void setClassesInSchoolJson(int schoolId, String jsonString) {
        setClassesInSchool(schoolId, parseJsonToClassMap(jsonString));
    }

    public void setBooksListInClassJson(int classId, String jsonString) {
        setBooksListInClass(classId, parseJsonToBookMap(jsonString));
    }

    public HashMap<Integer, String> parseJsonToMap(String jsonString) {
        HashMap<Integer, String> map = new Gson().fromJson(jsonString, new TypeToken<HashMap<Integer, String>>() {
        }.getType());
        return map;
    }

    public HashMap<Integer, School> parseJsonToSchoolMap(String jsonString) {
        HashMap<Integer, String> map = new Gson().fromJson(jsonString, new TypeToken<HashMap<Integer, String>>() {
        }.getType());
        HashMap<Integer, School> schoolMap = new HashMap<>();
        for (Map.Entry<Integer, String> entry : map.entrySet()) {
            Integer id = entry.getKey();
            School school = new School();
            school.setId(id);
            school.setName(entry.getValue());
            schoolMap.put(id, school);
        }
        return schoolMap;
    }

    public HashMap<Integer, Clazz> parseJsonToClassMap(String jsonString) {
        HashMap<Integer, String> map = new Gson().fromJson(jsonString, new TypeToken<HashMap<Integer, String>>() {
        }.getType());
        HashMap<Integer, Clazz> classMap = new HashMap<>();
        for (Map.Entry<Integer, String> entry : map.entrySet()) {
            Integer id = entry.getKey();
            Clazz classItem = new Clazz();
            classItem.setId(id);
            classItem.setName(entry.getValue());
            classMap.put(id, classItem);
        }
        return classMap;
    }

    public HashMap<Integer, Book> parseJsonToBookMap(String jsonString) {
        HashMap<Integer, String> map = new Gson().fromJson(jsonString, new TypeToken<HashMap<Integer, String>>() {
        }.getType());
        HashMap<Integer, Book> bookMap = new HashMap<>();
        for (Map.Entry<Integer, String> entry : map.entrySet()) {
            Integer id = entry.getKey();
            Book book = new Book();
            book.setId(id);
            book.setName(entry.getValue());
            bookMap.put(id, book);
        }
        return bookMap;
    }


}