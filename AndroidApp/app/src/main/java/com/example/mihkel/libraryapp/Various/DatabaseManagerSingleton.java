package com.example.mihkel.libraryapp.Various;

import com.example.mihkel.libraryapp.Item.Book;
import com.example.mihkel.libraryapp.Item.Clazz;
import com.example.mihkel.libraryapp.Item.Item;
import com.example.mihkel.libraryapp.Item.School;
import com.example.mihkel.libraryapp.R;
import com.google.gson.Gson;
import com.google.gson.reflect.TypeToken;

import java.util.ArrayList;
import java.util.Arrays;
import java.util.HashMap;
import java.util.List;
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
    private static HashMap<Integer, Book> booksData = new HashMap<>();

    private DatabaseManagerSingleton() {

    }

    public synchronized static DatabaseManagerSingleton getInstance() {
        if (_instance == null) {
            _instance = new DatabaseManagerSingleton();
        }
        return _instance;
    }

    //
    //----------------------------------------------------------------------------------------------------
    // SETTERS begin:

    public void setSchoolsList(HashMap<Integer, School> map) {
        schoolsData = map;
    }

    public void setClassesInSchool(int schoolId, HashMap<Integer, Clazz> map) {
        classesBySchoolData.put(schoolId, map);
    }

    public void addBook(Book book) {
//        if (!hasBook(book.getId()))
        booksData.put(book.getId(), book);
    }


    public void setSchoolListResult(String jsonString) {
        setSchoolsList(parseJsonToSchoolMap(jsonString));
    }


    public void setBooksListInClass(int classId, HashMap<Integer, Book> map) {
        booksByClassesData.put(classId, map);
        for (Book book : map.values()) {
            addBook(book);
        }
    }

    public void setClassesInSchoolJson(int schoolId, String jsonString) {
        setClassesInSchool(schoolId, parseJsonToClassMap(jsonString));
    }

    public void setBooksListInClassJson(int classId, String jsonString) {
        setBooksListInClass(classId, parseJsonToBookMap(jsonString));
    }


    // SETTERS end
    //----------------------------------------------------------------------------------------------------
    // GETTERS begin

    public Book getBook(Integer bookId) {
        return booksData.get(bookId);
    }

    public HashMap<Integer, School> getSchoolsList() {
        return schoolsData;
    }

    public HashMap<Integer, Clazz> getClassesInSchool(int schoolId) {
        return classesBySchoolData.get(schoolId);
    }

    public HashMap<Integer, Book> getBooksListInClass(int classId) {
        return booksByClassesData.get(classId);
    }

    // GETTERS end
    //----------------------------------------------------------------------------------------------------
    // CHECKERS start

    public boolean hasSchoolsList() {
        return schoolsData != null;
    }

    public boolean hasClassesInSchool(int schoolId) {
        return classesBySchoolData.get(schoolId) != null;
    }


    public boolean hasBook(Integer selectedBookId) {
        return booksData.get(selectedBookId) != null;
    }

    public boolean hasBooksListInClass(int classId) {
        return booksByClassesData.get(classId) != null;
    }


    // CHECKERS end
    //----------------------------------------------------------------------------------------------------
    //


    public HashMap<Integer, String> parseIntegerKeyJsonToMap(String jsonString) {
        HashMap<Integer, String> map = new Gson().fromJson(jsonString, new TypeToken<HashMap<Integer, String>>() {
        }.getType());
        return map;
    }

    public HashMap<String, String> parseStringKeyJsonToMap(String jsonString) {
        HashMap<String, String> map = new Gson().fromJson(jsonString, new TypeToken<HashMap<String, String>>() {
        }.getType());
        return map;
    }

    public List<Item> hashMapToList(HashMap<Integer, String> authorMap) {
        ArrayList<Item> authorList = new ArrayList<>();
        for (Map.Entry<Integer, String> entry : authorMap.entrySet()) {
            Integer id = entry.getKey();
            Item author = new Item();
            author.setId(id);
            author.setName(entry.getValue());
            authorList.add(author);
        }
        return authorList;
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

    public ArrayList<Item> getAuthors() {
        String[] arr = {"Paries,France", "PA,United States", "Parana,Brazil", "Padua,Italy", "Pasadena,CA,United States"};
        ArrayList<Item> authorList = new ArrayList<>();
        int i = 0;
        for (String name : arr) {
            Item school = new Item();
            school.setId(i);
            school.setName(name);
            authorList.add(school);
            i++;
        }
        return authorList;
    }

    public ArrayList<Item> getGenericList(int type) {
        List<String> list = new ArrayList<>();
        switch (type) {
            case R.id.TAG_AUTHOR:
                list = Arrays.asList("Rowling", "oskar luts", "otomann otoo", "oolo");
                break;
            case R.id.TAG_BOOK:
                list = Arrays.asList("harry potter", "lord of the rings", "lord of the flies", "bonanza", "laaadapäevad");
                break;
            case R.id.TAG_GENRE:
                list = Arrays.asList("ulme", "komöödia", "noortele", "õudus");
                break;
            case R.id.TAG_KEYWORD:
                list = Arrays.asList("lapsed", "loomad", "suvi", "talv");
                break;
        }
        ArrayList<Item> authorList = new ArrayList<>();
        int i = 0;
        for (String name : list) {
            Item school = new Item();
            school.setId(i);
            school.setName("a" + name);
            authorList.add(school);
            i++;
        }
        return authorList;
    }


    public void setBookInfo(Integer bookId, String jsonString) {
        Book book = new Book();
        HashMap<String, String> bookInfoMap = parseStringKeyJsonToMap(jsonString);
        book.setId(Integer.parseInt(bookInfoMap.get("id")));
        book.setName(bookInfoMap.get("title"));
        book.setAuthors(bookInfoMap.get("authors"));
        book.setGenres(bookInfoMap.get("genres"));
        book.setKeywords(bookInfoMap.get("keywords"));
        book.setLanguages(bookInfoMap.get("lang"));
        book.setYear(Integer.valueOf(bookInfoMap.get("year")));

        addBook(book);

    }
}
