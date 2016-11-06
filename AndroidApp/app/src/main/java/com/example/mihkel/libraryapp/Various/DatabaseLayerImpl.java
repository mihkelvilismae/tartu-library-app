package com.example.mihkel.libraryapp.Various;

import com.example.mihkel.libraryapp.Interfaces.DatabaseLayer;
import com.example.mihkel.libraryapp.Item.Author;
import com.example.mihkel.libraryapp.Item.Book;
import com.example.mihkel.libraryapp.Item.Clazz;
import com.example.mihkel.libraryapp.Item.School;
import com.google.gson.Gson;
import com.google.gson.reflect.TypeToken;

import java.util.HashMap;
import java.util.Map;

/**
 * Created by mihkel on 26.10.2016.
 */
public class DatabaseLayerImpl implements DatabaseLayer {
    @Override
    public Map<Integer, School> getSchools() {
//        HashMap<Integer, String> schoolsById = new HashMap<>();
//        schoolsById.put(1, "Desquartee kool");
//        schoolsById.put(2, "MHG");
//        schoolsById.put(3, "Viinakuradi gümnaasium");
//        schoolsById.put(4, "GAGSWag");
//        schoolsById.put(5, "Eluülikool");
///
//        return schoolsById;
        return DatabaseManagerSingleton.getInstance().getSchoolsList();
    }

    @Override
    public HashMap<Integer, Clazz> getClasses(Integer schoolId) {
//        HashMap<Integer, String> classesById = new HashMap<>();
//        classesById.put(1, "5B");
//        classesById.put(2, "3G");
//        classesById.put(3, "4G");
//        classesById.put(4, "11C");
//        classesById.put(5, "15B");
//
//        return classesById;
        return DatabaseManagerSingleton.getInstance().getClassesInSchool(schoolId);
    }

    @Override
    public HashMap<Integer, Book> getReadingList(Integer classId) {
//        HashMap<Integer, String> classesById = new HashMap<>();
//        classesById.put(1, "Pasapeetri aabits");
//        classesById.put(2, "Berti päevikud");
//        classesById.put(3, "Armastus hobuse vastu");
//        classesById.put(4, "Tõde ja õigus");
//        classesById.put(5, "Vale ja õiglusetus");
//
//        return classesById;
        return DatabaseManagerSingleton.getInstance().getBooksListInClass(classId);
    }

    public HashMap<Integer, Author> getAuthors() {
        String[] arr = {"Paries,France", "PA,United States", "Parana,Brazil", "Padua,Italy", "Pasadena,CA,United States"};
        HashMap<Integer, Author> schoolMap = new HashMap<>();
        int i = 0;
        for (String name : arr) {
            Author school = new Author();
            school.setId(i);
            school.setName(name);
            schoolMap.put(i, school);
            i++;
        }
        return schoolMap;
    }

}
