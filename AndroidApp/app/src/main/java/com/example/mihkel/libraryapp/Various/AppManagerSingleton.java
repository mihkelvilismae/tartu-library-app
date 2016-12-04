package com.example.mihkel.libraryapp.Various;

import android.app.Activity;
import android.view.View;
import android.view.inputmethod.InputMethodManager;

public class AppManagerSingleton {
    public static final String SCHOOL_ID = "schoolId";

    public static Integer selectedSchoolId;
    public static Integer selectedClassId;
    public static Integer selectedBookListId;
    public static Integer selectedBookId;
//    public static Integer selectedId;

    private static AppManagerSingleton _instance;
//    private static HashMap<Integer, HashMap<Integer, String>> data = new HashMap<Integer, HashMap<Integer, String>>();

    private AppManagerSingleton() {

    }

    public synchronized static AppManagerSingleton getInstance() {
        if (_instance == null) {
            _instance = new AppManagerSingleton();
        }
        return _instance;
    }

//    //http://stackoverflow.com/questions/1109022/close-hide-the-android-soft-keyboard
//    public static void hideKeyboard(Activity activity) {
//        InputMethodManager imm = (InputMethodManager) activity.getSystemService(Activity.INPUT_METHOD_SERVICE);
//        //Find the currently focused view, so we can grab the correct window token from it.
//        View view = activity.getCurrentFocus();
//        //If no view currently has focus, create a new one, just so we can grab a window token from it
//        if (view == null) {
//            view = new View(activity);
//        }
//        imm.hideSoftInputFromWindow(view.getWindowToken(), 0);
//    }
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